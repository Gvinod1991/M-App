import React from 'react';
import {TouchableHighlight,Text, View,ScrollView,AsyncStorage} from 'react-native';
import { Header,Avatar,Card, Button, Icon} from 'react-native-elements';
import LogoComponent from '../common/LogoComponent';
import Loader from '../common/Loader';
import config from '../config';
export default class ServiceDetailScreen extends React.Component {
  //static navigationOptions = { header: null }
  constructor(props) {
    super(props);
    this.state={
      'userToken':"",
      'vendor':[],
      'service':[],
      'timeslot':[],
      'message':"",
      'loader':false,
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
        this.state.loading=false;
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
  
  render() {
    console.disableYellowBox = true;
    const Left = ({ onPress }) => (
      <TouchableHighlight onPress={onPress}>
       <Icon name="arrow-left" type="font-awesome" color="#111" />
      </TouchableHighlight>
    ); 
    const { goBack } = this.props.navigation;
    return (
      <View style={{flex: 1,backgroundColor:'#f5f5f5'}}>
      <Loader loading={this.state.loading} />
      <Header leftComponent={<Left onPress={() => goBack()} />} outerContainerStyles={{paddingBottom:10,backgroundColor:'#FFEB3B'}}  centerComponent={<LogoComponent />}/> 
      <ScrollView> 
        {
      this.state.vendor && 
          <Card
            title={this.state.vendor.shop_name}
            image={require('../images/banner.jpg')}>
            <Text style={{marginBottom: 10}}>
            {this.state.vendor.addr}
            </Text>
            <View style={{flexDirection:'row',justifyContent:"space-between",alignItems: 'baseline'}}>
            <Icon name="map-marker" type="font-awesome" color="#ccc" />
            <Text> {this.state.vendor.city}</Text>
            <Text> | </Text>
            <Icon name="clock-o" type="font-awesome" color="#ccc" />
            <Text> {this.state.vendor.open_at} - {this.state.vendor.close_at}</Text>
            </View>
            <View style={{paddingTop:30,padding:5}}>
              <Text h3>Our Services</Text>
              {
                this.state.service.map((serv,index) =>
                <View key={index} style={{flexDirection:'row',justifyContent:"space-between",alignItems: 'baseline',padding:10}}>
                <Avatar
                  medium
                  rounded
                  source={{uri: "https://s3.amazonaws.com/uifaces/faces/twitter/kfriedson/128.jpg"}}
                  onPress={() => console.log("Works!")}
                  activeOpacity={0.7}
                />
                <Text >{serv.service_name}</Text>
                <Text >{serv.service_price}</Text>
                <Button
          icon={<Icon name='code' color='#ffffff' />}
          backgroundColor='#03A9F4'
          buttonStyle={{borderRadius: 0, marginLeft: 0, marginRight: 0, marginBottom: 0}}
          title='Book Now' onPress={() => this.props.navigation.navigate('Home')}/>
                </View>
              )}
              
            </View>
          </Card>
        }
      </ScrollView>      
      </View>
    );
  }
}



