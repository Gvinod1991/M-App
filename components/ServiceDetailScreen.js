import React from 'react';
import {TouchableHighlight,Text, View,ScrollView,AsyncStorage,StyleSheet,Image,Modal,Dimensions,DatePickerAndroid,TimePickerAndroid,Picker} from 'react-native';
import { Header,Avatar,Card, Button, Icon,FormInput,FormValidationMessage,FormLabel} from 'react-native-elements';
import { MapView } from 'expo';
import LogoComponent from '../common/LogoComponent';
import Loader from '../common/Loader';
import config from '../config';
import BackComponent from '../common/BackComponent';
import PayuMoney from 'react-native-payumoney';
export default class ServiceDetailScreen extends React.Component {
  //static navigationOptions = { header: null }
  constructor(props) {
    super(props);
    this.state={
      userToken:"",
      vendor:[],
      service:[],
      timeslot:[],
      message:"",
      loader:false,
      isModalOpen:false,
      seats:['0'],
        }   
    this._retrieveuserToken();
  }
  //AsyncStorage.removeItem('userToken');
  _retrieveuserToken = async () => {
    try {
      const userToken = await AsyncStorage.getItem('userToken');
      if (userToken !== null) {
        // We have data!!
        this.getVendor(userToken);
        this.getInventory(userToken);
        this.setState({ userToken: userToken})
      }
      } catch (error) {
        // Error retrieving data
      }
  }
  
  //Function to get the user details
  getVendor = (userToken) => {
    
    const url=config.apiEndpoint+"vendor/"+this.props.navigation.state.params.vendorId;
    fetch(url, {
      method: 'GET',
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
        'Authorization': 'Bearer '+userToken
      }
    }).then((response) => response.json())
      .then((responseJson) => {
        this.setState({loading:false});
        if(responseJson.status==1)
        {
          this.setState({ vendor: responseJson.vendorData.vendor});        
        }
        else
        {
          this.setState({ message: "No saloons found in this area,Try with other location!"});
        }
      })
      .catch((error) => {
        console.error(error);
      });
  }
  //Function to get the user details
  getInventory = (userToken) => {
    const url=config.apiEndpoint+"public-user/checkavailability";
    fetch(url, {
      method: 'POST',
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
        'Authorization': 'Bearer '+userToken
      },
      body: JSON.stringify({
        book_date:this.state.pickerFromInput,
        vendor_id:this.props.navigation.state.params.vendorId
      })
    }).then((response) => response.json())
      .then((responseJson) => {
        this.setState({loading:false});
        if(responseJson.status==1)
        {
          this.setState({ service: responseJson.vendorData.service});
          this.setState({ timeslot: responseJson.vendorData.timeslot});
        }
        else
        {
          this.setState({ message: "No services active for this saloon"});
        }
      })
      .catch((error) => {
        console.error(error);
      });
  }
  bookNow=(service_name,service_id,service_price)=>{
    this.setState({isModalOpen:true});
    this.setState({selectedService:service_name});
    this.setState({selectedServiceId:service_id});
    this.setState({service_price:service_price});
    this.setState({pickerFromInput:this.getNextDate(new Date(),0)});
  }
    //Get the next date from first argument with provided length of next date from today in 2nd argumnet
    getNextDate = (today, length) => {
      var myDate = new Date(today); //create new date from the original
      myDate.setDate(myDate.getDate() + length); //set new date 7 days from now(the correct 7 days)
      var fullYear = myDate.getFullYear(); //store fullyear (IE 2010) to fullYear var
      var month = ((myDate.getMonth()) < 9) ? ('0' + (myDate.getMonth() + 1)) : myDate.getMonth() + 1; //store 2 digit month to month var
      var day = (myDate.getDate() < 10) ? ('0' + myDate.getDate()) : myDate.getDate(); //store 2 digit day to day var
      var myNewDate = day + '-' + month + '-' + fullYear; //combine all 3 variables and store the output to myNewDate var.
      return myNewDate;
  }
  closeBookModal = () =>{
    this.setState({isModalOpen:false});
  }
  setSeats = (time_slot_id) => {
    this.setState({time_slot_id : time_slot_id});
    this.state.timeslot.map((time_slot)=>{
      if(time_slot.id==time_slot_id){
        this.setState({time_slot_name:time_slot.timing});
        let seats=[];
        for(let i=1;i<=time_slot.max_limit_booking;i++){
          seats.push(i.toString());
        }
        this.setState({seats: seats.length> 0 ? seats :false});
      }
    });
  }
  //Set the seat count in state and calculate the total amount to pay
  setSeatCount = (seat_count) => {
    this.setState({selectedSeat : seat_count});
    this.setState({total_amount: seat_count * this.state.service_price});
  }
  //to handle state of the user inputs
  handleChange(value,name) {
    this.setState({[name]: value})//dynamically set the state
  }
  //Get JS date from "YYYY-mm-dd" formated date
  getJsDate = (date) => {
    var daArr = [];
    daArr = date.split("-");
    return new Date(daArr[2], parseInt(daArr[1]) - 1, parseInt(daArr[0]));//Convert js date
  }
  //Android Date picker
  openDatePicker= async ()=>{
    try {
      const {action, year, month, day} = await DatePickerAndroid.open({
        // Use `new Date()` for current date.
        // May 25 2020. Month 0 is January.
        date: new Date(),
        mode:'spinner',
        minDate:new Date(),
        maxDate:this.getJsDate(this.getNextDate(new Date(),2))
      });
      if (action !== DatePickerAndroid.dismissedAction) {
        // Selected year, month (0-11), day
        month=month+1;
        let strMonth= month < 10 ?'0'+month : month;
        let strDay= day < 10 ?'0'+day : day;
        this.setState({pickerFromInput:year+'-'+strMonth+'-'+strDay},this.getInventory);
      }
    } catch ({code, message}) {
      console.warn('Cannot open date picker', message);
    }
  }
  //Book seats 
  payNow= () => {
    const url=config.apiEndpoint+"public-user/booknow";
    fetch(url, {
      method: 'POST',
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
        'Authorization': 'Bearer '+this.state.userToken
      },
      body: JSON.stringify({
        book_date:this.state.pickerFromInput,
        vendor_id:this.props.navigation.state.params.vendorId,
        timeslot_id:this.state.time_slot_id,
        time_slot:this.state.time_slot_name,
        service_name:this.state.selectedService,
        tot_cost:this.state.total_amount,
        no_seat:this.state.selectedSeat
      })
    }).then((response) => response.json())
      .then((responseJson) => {
        this.setState({loading:false});
        console.log(responseJson);
      })
      .catch((error) => {
        console.error(error);
      });
  }
  payumoney= () => {
    let amount = 99.9;
let txid = new Date().getTime()+"";
let productId = "product101";
let name = "asdf";
let email = "hello@world.com";
let phone = "1231231231";
let surl = config.apiEndpoint+'payu-validate'; //can be diffrennt for Succes
let furl = config.apiEndpoint+'payu-validate'; //can be diffrennt for Failed
let id = "6418320"; //Your Merchant ID here
let key = "7KB3CDZE"; //Your Key Here
let sandbox = true; //Make sure to set false on production or you will get error
fetch(config.apiEndpoint+'payu-hash', {
    method: 'POST',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'Authorization': 'Bearer '+this.state.userToken
    },
    body: JSON.stringify({
        key: key,
        txnid: txid,
        amount: amount,
        productinfo: productId,
        firstname: name,
        email: email
    }),
})
    .then((response) => response.json())
    .then((hash) => {
        let options = {
            amount: amount,
            txid: txid ,
            productId: productId,
            name: name,
            email: email,
            phone: phone,
            id: id,
            key: key,
            surl: surl,
            furl: furl,
            sandbox: sandbox,
            hash: hash
        };
        console.log(options);
        PayuMoney.pay(options).then((d) => {
            console.log(d); // WIll get a Success response with verification hash
        }).catch(e => {
            console.log(e); //In case of failture 
        });
    })
  }
  render() {
    console.disableYellowBox = true;
    const CloseComponent = () => (
      <TouchableHighlight  onPress={()=>this.closeBookModal()}><View><Icon size={32} name="close" color='#FF3B70' type="material-community" /></View></TouchableHighlight>
    );
    let timeSlotItems = this.state.timeslot && this.state.timeslot.map( (slot, i) => {
      return <Picker.Item key={i} value={slot.id} label={slot.timing} />
    });
    let seatItems = this.state.seats && this.state.seats.map( (seat, i) => {
      return <Picker.Item key={i} value={seat} label={seat} />
    });
    const { goBack } = this.props.navigation;
    return (
      <View style={{flex: 1,backgroundColor:'#f0f3f7'}}>
      <Loader loading={this.state.loading} />
      <Header leftComponent={<BackComponent navigation={this.props.navigation} />} outerContainerStyles={{paddingBottom:10,backgroundColor:'#FFF'}}  centerComponent={<LogoComponent />}/> 
      <ScrollView> 
        {
      this.state.vendor && 
          <Card
            title={this.state.vendor.shop_name}
            titleStyle={{fontSize:26,color:'#FF3B70'}}
            image={{uri: config.public_image_url+'public/'+this.state.vendor.photo}}>
            <Text style={{marginBottom: 10}}>
            {this.state.vendor.description + 'We are situated at '+this.state.vendor.addr}
            </Text>
            <View style={{flexDirection:'row',justifyContent:"space-between",alignItems: 'baseline'}}>
            <Icon name="map-marker" type="font-awesome" color="#FF3B70" />
            <Text> {this.state.vendor.city}</Text>
            <Text> | </Text>
            <Icon name="clock-o" type="font-awesome" color="#FF3B70" />
            <Text> {this.state.vendor.open_at} - {this.state.vendor.close_at}</Text>
            </View>
            <View style={{paddingTop:30,padding:5}}>
              <Text style={{textAlign:'center',fontSize:25,borderBottomWidth:2,borderBottomColor:'#FF3B70'}} h2>Our Services</Text>
              {
                this.state.service.map((serv,index) =>
                <View key={index} style={{paddingTop:10,flexDirection:'row',justifyContent:"space-between"}}>
                <Avatar
                  medium
                  rounded
                  source={{uri: config.public_image_url+'public/'+serv.service_image}}
                  activeOpacity={0.7}
                />
                <View style={{flexDirection:'column',justifyContent:"space-between"}}>
                <Text h3>{serv.service_name}</Text>
                <View style={{flexDirection:'row',justifyContent:"center"}}>
                <Icon name="inr" type="font-awesome" color="#FF3B70" />
                <View><Text style={{fontSize:24}}>{serv.service_price}</Text></View>
                </View>
                </View>
                <Button
                  buttonStyle={styles.button}
                  style={{borderRadius: 30}}
                  title='Book Now' onPress={() => this.bookNow(serv.service_name,serv.id,serv.service_price)}/>
                </View>
              )}
              
            </View>
            {/*
      this.state.vendor && 
            <View style={{paddingTop:30,padding:5}}>
              <Text style={{textAlign:'center',fontSize:25,borderBottomWidth:2,borderBottomColor:'#FF3B70'}} h2>Locate us @</Text>
                <View style={{paddingTop:20,flexDirection:'row',justifyContent:"space-between"}}>
                {//<Image source={require('../images/map.png') }>
                }
                <MapView
                      style={{
                       width:500,
                       height:500
                      }}
                      initialRegion={{
                        latitude: 37.78825,
                        longitude: -122.4324,
                        latitudeDelta: 0.0922,
                        longitudeDelta: 0.0421
                      }}
                    />
                </View>
            </View>*/
            }
              {
      this.state.vendor && 
            <View style={{paddingTop:30,padding:5}}>
              <Text style={{textAlign:'center',fontSize:25,borderBottomWidth:2,borderBottomColor:'#FF3B70'}} h2>Follow us @</Text>
                <View style={{paddingTop:20,flexDirection:'row',justifyContent:"space-between"}}>
                <Icon name="facebook" type="font-awesome" color="#FF3B70" />
                <Icon name="twitter" type="font-awesome" color="#FF3B70" />
                <Icon name="instagram" type="font-awesome" color="#FF3B70" />
                <Icon name="youtube" type="font-awesome" color="#FF3B70" />
                </View>
            </View>
              }
          </Card>
        }
        <Modal visible={this.state.isModalOpen}
                onRequestClose={() => this.setState({isModalOpen: false})} animationType={"slide"}
               >
                <View  style={{flex: 1,backgroundColor:'#f5f5f5'}}> 
                  <Header outerContainerStyles={{backgroundColor:'#fff'}}  leftComponent={<CloseComponent />}
                      centerComponent={{ text: this.state.selectedService, style: { color: '#FF3B70',fontWeight:'bold',fontSize:22 } }}
                      />
                    <Card >
                    <Text style={{fontSize:18}}>Booking Date</Text>
                    <View style={{flexDirection:'row'}}>
                    <Icon onPress={()=>this.openDatePicker()} name="calendar" type="simple-line-icon" style={{padding:10}} />
                    <FormInput underlineColorAndroid="#ccc" shake={this.state.error}
                    editable={false} 
                    value={this.state.pickerFromInput} 
                    inputStyle={{fontSize:18}} /> 
                    { this.state.errorBookDate && 
                        <FormValidationMessage >{this.state.errorBookDate}</FormValidationMessage>
                    }
                    </View>
                    <View>
                    <Text style={{fontSize:18}}>Time Slot</Text>
                    <Picker
                        selectedValue={this.state.time_slot_id}
                        onValueChange={(time_slot_id, index) => this.setSeats(time_slot_id)}>
                        {timeSlotItems}
                    </Picker>
                    </View>
                   
                    <View>
                    <Text style={{fontSize:18}}>No of seats</Text>
                      <Picker
                          selectedValue={this.state.selectedSeat}
                          onValueChange={(seat_count, index) => this.setSeatCount(seat_count)}>
                          {seatItems}
                        </Picker>
                    </View>
                    <View>
                      <Text style={{fontSize:18}}>Total Amount</Text></View>
                      <View><Text>{this.state.total_amount}</Text>
                    </View>
                  <Button
                        onPress={()=>this.payumoney()}
                        backgroundColor='#FF3B70'
                        buttonStyle={{borderRadius: 30, marginLeft: 0, marginRight: 0, marginBottom: 0}}
                        title='Pay Now' />
                    </Card>
                </View>
            </Modal>
      </ScrollView>      
      </View>
    );
  }
}
const styles = StyleSheet.create({

  button: {
    margin: 5,
    borderRadius: 30,
    backgroundColor:'#FF3B70'
  },
  icon:{
    color:'#FF3B70'
  },
  modalBackground: {
    flex: 1,
    alignItems: 'center',
    flexDirection: 'column',
    justifyContent: 'space-around',
    backgroundColor: '#00000040',
    height: Dimensions.get('window').height,
    width:Dimensions.get('window').width
  }
})



