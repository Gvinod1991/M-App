
import React from 'react';
import {TouchableHighlight,Text, View,TextInputImage ,Image,ScrollView  } from 'react-native';
import { Header,Avatar,Card, Divider, Button, Icon,SearchBar,FormLabel, FormInput, FormValidationMessage} from 'react-native-elements';
import Logout from './Logout';
export default class ProfileScreen extends React.Component {
  static navigationOptions = { header: null }
  render() {
    console.disableYellowBox = true;
    return (
      <View style={{flex: 1,backgroundColor:'#f5f5f5'}}>
      <Header  outerContainerStyles={{paddingBottom:0}} centerComponent={{ text: 'MY STYLE', style: { color: '#fff' } }} 
      rightComponent={<Logout navigate={this.props.navigation.navigate}/>} /> 
    
      <ScrollView>
            <View style={{paddingTop:30,padding:5,backgroundColor:'#f5f5f5'}}>
                <View style={{flexDirection:'row',justifyContent:'center'}}>
                <Avatar
                    xlarge
                    rounded
                    source={{uri: "https://s3.amazonaws.com/uifaces/faces/twitter/kfriedson/128.jpg"}}
                    onPress={() => console.log("Works!")}
                    activeOpacity={0.7}
                    style={{padding:30}}
                />
                </View>
                <View style={{flexDirection:'row',justifyContent:'space-between',border:'#f5f5f5',padding:5,backgroundColor:'#fff'}}>
                 <Text style={{fontSize:20,padding:5}}>Godti Vinod</Text>
                 <Icon style={{fontSize:20,padding:5}} name="pencil" color="#ccc" type="font-awesome"/>
                </View>
                <View style={{border:'#f5f5f5',padding:5,backgroundColor:'#fff'}}>
                 <Text style={{fontSize:18,padding:5}}>About and contact</Text>
                 <View style={{flexDirection:'row'}}>
                 <Icon name="phone" color="#ccc" type="font-awesome"/>
                 <Text style={{fontSize:16,padding:20}}>+91-9861562948</Text>
                 </View>
                 <Divider style={{ backgroundColor: '#ccc' }} />
                 <View style={{flexDirection:'row'}}>
                 <Icon name="envelope" color="#ccc" type="font-awesome"/>
                 <Text style={{fontSize:16,padding:20}}>venkat.godti3@gmail.com</Text>
                 </View>
                 <Divider style={{ backgroundColor: '#ccc' }} />
                 <View style={{flexDirection:'row'}}>
                 <Icon name="map-marker" color="#ccc" type="font-awesome"/>
                 <Text style={{fontSize:16,padding:20}}>Bhubaneswar,Odisha,India</Text>
                 </View>
                </View>
            </View>
      </ScrollView>      
      </View>
    );
  }
}
