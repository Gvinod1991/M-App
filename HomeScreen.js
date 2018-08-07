
import React from 'react';
import {TouchableHighlight,Text, View,TextInputImage ,Image,ScrollView  } from 'react-native';
import { Header,Avatar,Card, ListItem, Button, Icon,SearchBar,FormLabel, FormInput, FormValidationMessage} from 'react-native-elements';
import Logout from './Logout';
export default class HomeScreen extends React.Component {
  static navigationOptions = { header: null }
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
        <TouchableHighlight onPress={() => this.props.navigation.navigate('Service')}>
          <Card
            title='Saloon One'
            image={require('./images/banner.jpg')}>
            <Text style={{marginBottom: 10}}>
              The idea with React Native Elements is more about component structure than actual design.
            </Text>
            <View style={{flexDirection:'row',justifyContent:"space-between"}}>
            <Icon name="map-marker" type="font-awesome" color="#ccc" />
            <Text> Jaydev vihar</Text>
            <Text> | </Text>
            <Icon name="heart-o" type="font-awesome" color="#ccc" />
            <Text> 5 </Text>
            <Text> | </Text>
            <Icon name="star" type="font-awesome" color="#1fa67a" />
            <Text> 5 </Text>
            </View>
          </Card>
          </TouchableHighlight>
          <TouchableHighlight onPress={() => this.props.navigation.navigate('Login')}>
          <Card onPress={() => this.props.navigation.navigate('LoginScreen')}
            title='Saloon Two'
            image={require('./images/banner.jpg')}>
            <Text style={{marginBottom: 10}}>
              The idea with React Native Elements is more about component structure than actual design.
            </Text>
            <View style={{flexDirection:'row',justifyContent:"space-between"}}>
            <Icon name="map-marker" type="font-awesome" color="#ccc" />
            <Text> Nayapally</Text>
            <Text> | </Text>
            <Icon name="heart-o" type="font-awesome" color="#ccc" />
            <Text> 4.5 </Text>
            <Text> | </Text>
            <Icon name="star" type="font-awesome" color="#1fa67a" />
            <Text> 4 </Text>
            </View>
          </Card>
          </TouchableHighlight>
          <TouchableHighlight onPress={() => this.props.navigation.navigate('Login')}>
          <Card
            title='Saloon Three'
            image={require('./images/banner.jpg')}>
            <Text style={{marginBottom: 10}}>
              The idea with React Native Elements is more about component structure than actual design.
            </Text>
            <View style={{flexDirection:'row',justifyContent:"space-between"}}>
            <Icon name="map-marker" type="font-awesome" color="#ccc" />
            <Text> CRPF Square</Text>
            <Text> | </Text>
            <Icon name="heart-o" type="font-awesome" color="#ccc" />
            <Text> 4 </Text>
            <Text> | </Text>
            <Icon name="star" type="font-awesome" color="#1fa67a" />
            <Text> 3.5 </Text>
            </View>
          </Card>
          </TouchableHighlight>
      </ScrollView>      
      </View>
    );
  }
}



