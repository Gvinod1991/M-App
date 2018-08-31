
import React from 'react';
import {TouchableHighlight,Text, View,TextInputImage ,Image,ScrollView,AsyncStorage } from 'react-native';
import { Header,Avatar,Card, ListItem, Button, Icon,SearchBar,FormLabel, FormInput, FormValidationMessage} from 'react-native-elements';
import Logout from './Logout';
export default class HomeScreen extends React.Component {
  static navigationOptions = { header: null }
  constructor(props) {
    super(props);
    this.state={
      'userToken':"",
      'vendors':[],
      'message':""
        }
    this._retrieveuserToken();
  }
  //AsyncStorage.removeItem('userToken');
  _retrieveuserToken = async () => {
    try {
      const userToken = await AsyncStorage.getItem('userToken');
      if (userToken !== null) {
        // We have data!!
        this.getVendors(userToken);
        this.setState({ userToken: userToken})
      }
      } catch (error) {
        // Error retrieving data
      }
  }
  //Function to get the user details
  getVendors = (userToken) => {
    const url="http://192.168.43.51/my-style-app/api/vendors";
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
        if(responseJson.status==1)
        {
          this.setState({ vendors: responseJson.vendors});
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

   render() {
    console.disableYellowBox = true;
    return (
      <View style={{flex: 1,backgroundColor:'#f5f5f5'}}>
      <Header  outerContainerStyles={{paddingBottom:0}} centerComponent={{ text: 'MY STYLE', style: { color: '#fff' } }} 
      rightComponent={<Logout navigate={this.props.navigation.navigate}/>}
/> 
    <SearchBar
      showLoading
      platform="android"
      placeholder='Search' />
      <ScrollView>
        {
          this.state.vendors.map((vendor,index) =>
          <TouchableHighlight key={index} onPress={() => this.props.navigation.navigate('Service',{vendorId:vendor.id})}>
          <Card 
            title={vendor.shop_name}
            image={require('./images/banner.jpg')}>
            <Text style={{marginBottom: 10}}>
              {vendor.addr}
            </Text>
            <View style={{flexDirection:'row',justifyContent:"space-between"}}>
            <Icon name="map-marker" type="font-awesome" color="#ccc" />
            <Text> {vendor.city}</Text>
            <Text> | </Text>
            <Icon name="heart-o" type="font-awesome" color="#ccc" />
            <Text> {vendor.open_at} </Text>
            <Text> | </Text>
            <Icon name="star" type="font-awesome" color="#1fa67a" />
            <Text> {vendor.close_at} </Text>
            </View>
          </Card>
          </TouchableHighlight>
          )}
      </ScrollView>      
      </View>
    );
  }
}



