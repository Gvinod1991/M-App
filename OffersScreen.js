
import React from 'react';
import {TouchableHighlight,Text, View,TextInputImage ,Image,ScrollView  } from 'react-native';
import { Header,Avatar,Card, Divider, Button, Icon,SearchBar,FormLabel, FormInput, FormValidationMessage} from 'react-native-elements';
import Logout from './Logout';
export default class OffersScreen extends React.Component {
  static navigationOptions = { header: null }
  render() {
    console.disableYellowBox = true;
    return (
      <View style={{flex: 1,backgroundColor:'#f5f5f5'}}>
      <Header  outerContainerStyles={{paddingBottom:0}} centerComponent={{ text: 'MY STYLE', style: { color: '#fff' } }} 
      rightComponent={<Logout navigate={this.props.navigation.navigate}/>} /> 
    
      <ScrollView>
            <View style={{backgroundColor:'#f5f5f5'}} >
                <View style={{flexDirection:'column',alignItems:'center',backgroundColor:'#fff',padding:20}}>
                <Avatar
                    large
                    source={{uri: "https://s3.amazonaws.com/uifaces/faces/twitter/kfriedson/128.jpg"}}
                    onPress={() => console.log("Works!")}
                    activeOpacity={0.7}
                    style={{padding:30}}
                />
                <Text style={{fontSize:20,padding:5}}>Offer Two</Text>
                </View>
                <Divider style={{ backgroundColor: '#ccc' }} />
                <View style={{flexDirection:'column',alignItems:'center',backgroundColor:'#fff',padding:20}}>
                <Avatar
                    large
                    source={{uri: "https://s3.amazonaws.com/uifaces/faces/twitter/kfriedson/128.jpg"}}
                    onPress={() => console.log("Works!")}
                    activeOpacity={0.7}
                    style={{padding:30}}
                />
                <Text style={{fontSize:20,padding:5}}>Offer One</Text>
                </View>
                <Divider style={{ backgroundColor: '#ccc' }} />
                <View style={{flexDirection:'column',alignItems:'center',backgroundColor:'#fff',padding:20}}>
                <Avatar
                    large
                    source={{uri: "https://s3.amazonaws.com/uifaces/faces/twitter/kfriedson/128.jpg"}}
                    onPress={() => console.log("Works!")}
                    activeOpacity={0.7}
                    style={{padding:30}}
                />
                <Text style={{fontSize:20,padding:5}}>Offer Three</Text>
                </View>
            </View>
      </ScrollView>      
      </View>
    );
  }
}
