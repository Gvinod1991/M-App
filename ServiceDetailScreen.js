
import React from 'react';
import {TouchableHighlight,Text, View,TextInputImage ,Image,ScrollView  } from 'react-native';
import { Header,Avatar,Card, ListItem, Button, Icon,SearchBar,FormLabel, FormInput, FormValidationMessage} from 'react-native-elements';
import Logout from './Logout';
export default class ServiceDetailScreen extends React.Component {
  static navigationOptions = { header: null }
  render() {
    console.disableYellowBox = true;
    return (
      <View style={{flex: 1,backgroundColor:'#f5f5f5'}}>
      <Header  outerContainerStyles={{paddingBottom:0}} centerComponent={{ text: 'MY STYLE', style: { color: '#fff' } }} 
      rightComponent={<Logout navigate={this.props.navigation.navigate}/>}
/> 
    
      <ScrollView>
       
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
            <Button
          icon={<Icon name='code' color='#ffffff' />}
          backgroundColor='#03A9F4'
          buttonStyle={{borderRadius: 0, marginLeft: 0, marginRight: 0, marginBottom: 0}}
          title='Book Now' onPress={() => this.props.navigation.navigate('Home')}/>
            <View style={{paddingTop:30,padding:5}}>
              <Text h4 >Our Services</Text>
              <View style={{flexDirection:'row',padding:10}}>
              <Avatar
                medium
                rounded
                source={{uri: "https://s3.amazonaws.com/uifaces/faces/twitter/kfriedson/128.jpg"}}
                onPress={() => console.log("Works!")}
                activeOpacity={0.7}
              />
              <Text >Cut/Style</Text>
              </View>
              <View style={{flexDirection:'row',padding:10}}>
              <Avatar
                medium
                rounded
                source={{uri: "https://s3.amazonaws.com/uifaces/faces/twitter/kfriedson/128.jpg"}}
                onPress={() => console.log("Works!")}
                activeOpacity={0.7}
              />
              <Text >Cut/Style</Text>
              </View>
              <View style={{flexDirection:'row',padding:10}}>
              <Avatar
                medium
                rounded
                source={{uri: "https://s3.amazonaws.com/uifaces/faces/twitter/kfriedson/128.jpg"}}
                onPress={() => console.log("Works!")}
                activeOpacity={0.7}
              />
              <Text >Cut/Style</Text>
              </View>
            </View>
          </Card>
      </ScrollView>      
      </View>
    );
  }
}



