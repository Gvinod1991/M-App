import React from 'react';
import {TouchableHighlight,Text, View,ScrollView,AsyncStorage,StyleSheet,Image,Modal,Dimensions,DatePickerAndroid,TimePickerAndroid,Picker} from 'react-native';
import { Header,Avatar,Card, Button, Icon} from 'react-native-elements';
import { MapView } from 'expo';
import LogoComponent from '../common/LogoComponent';
import Loader from '../common/Loader';
import config from '../config';
import BackComponent from '../common/BackComponent';
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
      seats:0
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
        this.setState({ userToken: userToken})
      }
      } catch (error) {
        // Error retrieving data
      }
  }
  //Function to get the user details
  getVendor = (userToken) => {
    
    const url=config.apiEndpoint+"vendor/"+this.props.navigation.state.params.vendorId;
    //const image_api_url='http://192.168.43.51/my-style-app/public';
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
          this.setState({ service: responseJson.vendorData.service});
          this.setState({ timeslot: responseJson.vendorData.timeslot});
          
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
  bookNow=()=>{
    this.setState({isModalOpen:true});
  }
  //Android Date picker
  openDatePicker= async ()=>{
    try {
      const {action, year, month, day} = await DatePickerAndroid.open({
        // Use `new Date()` for current date.
        // May 25 2020. Month 0 is January.
        date: new Date(),
        mode:'spinner'
      });
      if (action !== DatePickerAndroid.dismissedAction) {
        // Selected year, month (0-11), day
        month=month+1;
        let strMonth= month < 10 ?'0'+month : month;
        this.setState({pickerFromInput:year+'-'+strMonth+'-'+day})
      }
    } catch ({code, message}) {
      console.warn('Cannot open date picker', message);
    }
  }
  //Android time picker
  openTimePicker = async ()=>{
    try {
      const {action, hour, minute} = await TimePickerAndroid.open({
        hour: 14,
        minute: 0,
        is24Hour: false, // Will display '2 PM'
        mode:'spinner'
      });
      if (action !== TimePickerAndroid.dismissedAction) {
        // Selected hour (0-23), minute (0-59)
        console.log(hour);
      }
    } catch ({code, message}) {
      console.warn('Cannot open time picker', message);
    }
  }
  render() {
    console.disableYellowBox = true;
   
    const { goBack } = this.props.navigation;
    return (
      <View style={{flex: 1,backgroundColor:'#f5f5f5'}}>
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
            {this.state.vendor.shop_descr + 'We are situated at '+this.state.vendor.addr}
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
                  onPress={() => console.log("Works!")}
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
                  title='Book Now' onPress={() => this.bookNow()}/>
                </View>
              )}
              
            </View>
            {
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
            </View>
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
              transparent={true}>
              <View style={styles.modalBackground}>
              <Card
                  title='Select seats'
                  titleStyle={{fontSize:26,color:'#FF3B70'}}
                  >
                  <View style={{paddingTop:10,flexDirection:'row',justifyContent:"space-between"}} >
                  <View style={{flexDirection:'column'}}>
                    <Text>Pick Date</Text>
                    <Icon
                    color="#111" 
                      name="calendar-check-o" type="font-awesome" onPress={() => this.openDatePicker()}/>
                    <Text>{this.state.pickerFromInput}</Text>
                  </View>
                  <View style={{flexDirection:'column'}}>
                    <Text>Pick Time</Text>
                   <Icon
                   color="#111" 
                    name="clock-o" type="font-awesome" onPress={() => this.openTimePicker()}/>
                     <Text>{this.state.pickerFromInput}</Text>
                  </View>
                  <View style={{flexDirection:'column'}}>
                    <Text>No Of seats</Text>
                    <Picker
                      selectedValue={this.state.seats}
                      style={{ height: 50, width: 100 }}
                      onValueChange={(itemValue, itemIndex) => this.setState({seats: itemValue})}>
                      <Picker.Item label="1" value="1" />
                      <Picker.Item label="2" value="2" />
                      <Picker.Item label="3" value="3" />
                    </Picker>
                    <Text>{this.state.seats}</Text>
                  </View>
                  </View>
                  
                  <View style={{paddingTop:30,padding:5,flexDirection:'row',justifyContent:"space-between"}}>
                    <Button
                    buttonStyle={styles.button}
                    style={{borderRadius: 30}}
                    title='Pay Now' onPress={() => this.setState({isModalOpen: false})}/>
                    <Button
                    buttonStyle={styles.button}
                    style={{borderRadius: 30}}
                    title='Cancel' onPress={() => this.setState({isModalOpen: false})}/>
                  </View>
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



