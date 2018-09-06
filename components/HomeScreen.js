
import React from 'react';
import {TouchableHighlight,Text, View,Image,ScrollView,AsyncStorage,Platform } from 'react-native';
import { Header,Card, Icon,SearchBar} from 'react-native-elements';
import { Constants, Location, Permissions } from 'expo';
import LogoComponent from '../common/LogoComponent';
import Loader from '../common/Loader';
import config from '../config';
export default class HomeScreen extends React.Component {
  static navigationOptions = { header: null }
  constructor(props) {
    super(props);
    this.state={
      userToken:"",
      vendors:[],
      message:"",
      loading:true,
      location: null,
      errorMessage: null,
        }
    this._retrieveuserToken();
  }
  componentWillMount() {
    if (Platform.OS === 'android' && !Constants.isDevice) {
      this.setState({
        errorMessage: 'Oops, this will not work on Sketch in an Android emulator. Try it on your device!',
      });
    } else {
      this._getLocationAsync();
    }
  }

  _getLocationAsync = async () => {
    let { status } = await Permissions.askAsync(Permissions.LOCATION);
    if (status !== 'granted') {
      this.setState({
        errorMessage: 'Permission to access location was denied',
      });
    }

    let location = await Location.getCurrentPositionAsync({});
    this.setState({ location });
  };
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
    const url=config.apiEndpoint+'vendors';
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
    let text = 'Waiting..';
    if (this.state.errorMessage) {
      text = this.state.errorMessage;
    } else if (this.state.location) {
      console.log(this.state.location);
      text = JSON.stringify(this.state.location);
    }
    return (
      
      <View style={{flex: 1,backgroundColor:'#f5f5f5'}}>
      <Loader loading={this.state.loading} />
      <Header  outerContainerStyles={{paddingBottom:10,backgroundColor:'#FFEB3B'}}  centerComponent={<LogoComponent />} />
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
            image={require('../images/banner.jpg')}>
            <Text style={{marginBottom: 10}}>
              {vendor.addr}
            </Text>
            <View style={{flexDirection:'row',justifyContent:"space-between",alignItems: 'baseline'}}>
            <Icon name="map-marker" type="font-awesome" color="#ccc" />
            <Text> {vendor.city}</Text>
            <Text> | </Text>
            <Icon name="clock-o" type="font-awesome" color="#ccc" />
            <Text> {vendor.open_at} - {vendor.close_at}</Text>
            </View>
          </Card>
          </TouchableHighlight>
          )}
      </ScrollView>      
      </View>
    );
  }
}



