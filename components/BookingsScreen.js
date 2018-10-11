import React from 'react';
import {Text, View,ScrollView,AsyncStorage  } from 'react-native';
import { Header, Divider, Icon,Card} from 'react-native-elements';
import LogoComponent from '../common/LogoComponent';
import LeftComponent from '../common/LeftComponent';
import config from '../config';
export default class BookingsScreen extends React.Component {
  static navigationOptions = { header: null }
      constructor(props) {
        super(props);
        this.state={
          userToken:false,
          bookingDetails:false,
          noBookingDetails:false,
          loading:false
        }
        this._retrieveuserToken();
      }
      //Retrive Token
      _retrieveuserToken = async () => {
        try {
          let userToken= await AsyncStorage.getItem('userToken');
          if (userToken !== null) {
            // We have data!!
            this.setState({userToken:userToken},this._fetchBookings);
          }
          } catch (error) {
            console.log(error);
            // Error retrieving data
          }
      }

    //fetch OTA Today checkin
    _fetchBookings() {
      this.state.loading=true;
      const url=config.apiEndpoint+'public-user/bookinglist';
      console.log(url);
      fetch(url, {
        method: 'GET',
        headers: {
          Accept: 'application/json',
          'Content-Type': 'application/json',
          'Authorization': 'Bearer '+this.state.userToken
        }
      }).then((response) => response.json())
      .then((responseJson) => {
        this.state.loading=false;
        console.log(responseJson);
        if(responseJson.status==1)
        {
          this.setState({ bookingDetails: responseJson.bookings});
         
        }else{
          this.setState({ noBookingDetails:true})//If no bookings found of a user 
        }
      })
      .catch((error) => {
        console.error(error);
      });
    }
  render() {
    console.disableYellowBox = true;
    return (
      <View style={{flex: 1,backgroundColor:'#f0f3f7'}}>
       <ScrollView>
     <Header leftComponent={<LeftComponent navigation={this.props.navigation} />} outerContainerStyles={{paddingBottom:10,backgroundColor:'#FFF'}}  centerComponent={<LogoComponent />} />
     <View style={{flex:1}}>
          <Text style={{textAlign:'center',fontSize:25,color:'#FF3B70'}} h2>Bookings</Text>
          {this.state.bookingDetails && this.state.bookingDetails.map((booking,index)=>
          <Card key={index} containerStyle={{padding:5,elevation:3,borderWidth:0.1,borderRadius:5}}>
                <View style={{flexDirection:'column'}} >
                    <View style={{flex:1,flexDirection:'row',justifyContent:'flex-start'}}>
                        <Text style={{fontWeight:'300',color:'#666'}}>Booking ID</Text><Text>:</Text><Text>{booking.id}</Text>
                    </View>
                    <View style={{flex:1,flexDirection:'row',justifyContent:'flex-start'}}>
                        <Text style={{fontWeight:'300',color:'#666'}}>Date of Booking</Text><Text>:</Text><Text>{booking.book_date}</Text>
                    </View>
                    <View style={{flex:1,flexDirection:'row',justifyContent:'flex-start'}}>
                        <Text style={{fontWeight:'300',color:'#666'}}>Service Name</Text><Text>:</Text><Text>{booking.book_service}</Text>
                    </View>
                    <View style={{flex:1,flexDirection:'row',justifyContent:'flex-start'}}>
                        <Text style={{fontWeight:'300',color:'#666'}}>Seats</Text><Text>:</Text><Text>{booking.no_seat}</Text>
                    </View>
                    <View style={{flex:1,flexDirection:'row',justifyContent:'flex-start'}}>
                        <Text style={{fontWeight:'300',color:'#666'}}>Time Slot</Text><Text>:</Text><Text>{booking.time_slot}</Text>
                    </View>
                    <View style={{flex:1,flexDirection:'row',justifyContent:'flex-start'}}>
                        <Text style={{fontWeight:'300',color:'#666'}}>Total Amount</Text><Text>:</Text><Text>{booking.tot_cost}</Text>
                    </View>
                    <View style={{flex:1,flexDirection:'row',justifyContent:'flex-start'}}>
                        <Text style={{fontWeight:'300',color:'#666'}}>Saloon Details</Text><Text>:</Text><Text>{booking.shop_name+booking.addr+booking.locality}</Text>
                    </View>
                </View>
          </Card>
          )}
          {this.state.noBookingDetails &&
                <View style={{backgroundColor:'#FFF',justifyContent:'center',alignItems:'center',padding:10}}> 
                  <Icon size={28} name="magnifier" type="simple-line-icon" />
                  <Text> You have no bookings yet!</Text>
                </View>
          }
        </View>
      </ScrollView>
      </View>
    );
  }
}
