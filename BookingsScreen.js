
import React from 'react';
import {TouchableHighlight,Text, View,TextInputImage ,Image,ScrollView  } from 'react-native';
import { Header,Avatar,Card, Divider, Button, Icon,SearchBar,FormLabel, FormInput, FormValidationMessage} from 'react-native-elements';
import Logout from './Logout';
export default class BookingsScreen extends React.Component {
  static navigationOptions = { header: null }
  render() {
    console.disableYellowBox = true;
    return (
      <View style={{flex: 1,backgroundColor:'#f5f5f5'}}>
      <Header  outerContainerStyles={{paddingBottom:0}} centerComponent={{ text: 'MY STYLE', style: { color: '#fff' } }} 
      rightComponent={<Logout navigate={this.props.navigation.navigate}/>} /> 
    
      <ScrollView>
            <View style={{paddingTop:30,padding:5,backgroundColor:'#f5f5f5'}}>
            <Text style={{fontSize:22,padding:5}}>Bookings</Text>
                <View style={{flexDirection:'row',fontSize:18,fontWeight:'bold',justifyContent:'space-between',border:'#f5f5f5',padding:5,backgroundColor:'#fff'}}>
                 <Text >Date</Text>
                 <Text >Service</Text>
                 <Text >Saloon</Text>
                 <Text >Action</Text>
                </View>
                <Divider style={{ backgroundColor: '#ccc' }} />
                <View style={{flexDirection:'row',justifyContent:'space-between',border:'#f5f5f5',padding:20,backgroundColor:'#fff'}}>
                 <Text >01-08-2018</Text>
                 <Text >Service 1</Text>
                 <Text >Saloon 1</Text>
                 <Icon name="eye" color="#ccc" type="font-awesome"/>
                </View>
                <Divider style={{ backgroundColor: '#ccc' }} />
                <View style={{flexDirection:'row',justifyContent:'space-between',border:'#f5f5f5',padding:20,backgroundColor:'#fff'}}>
                 <Text >01-08-2018</Text>
                 <Text >Service 1</Text>
                 <Text >Saloon 1</Text>
                 <Icon name="eye" color="#ccc" type="font-awesome"/>
                </View>
                <Divider style={{ backgroundColor: '#ccc' }} />
                <View style={{flexDirection:'row',justifyContent:'space-between',border:'#f5f5f5',padding:20,backgroundColor:'#fff'}}>
                 <Text >01-08-2018</Text>
                 <Text >Service 1</Text>
                 <Text >Saloon 1</Text>
                 <Icon name="eye" color="#ccc" type="font-awesome"/>
                </View>
                <Divider style={{ backgroundColor: '#ccc' }} />
                <View style={{flexDirection:'row',justifyContent:'space-between',border:'#f5f5f5',padding:20,backgroundColor:'#fff'}}>
                 <Text >01-08-2018</Text>
                 <Text >Service 1</Text>
                 <Text >Saloon 1</Text>
                 <Icon name="eye" color="#ccc" type="font-awesome"/>
                </View>
                <Divider style={{ backgroundColor: '#ccc' }} />
                
            </View>
      </ScrollView>      
      </View>
    );
  }
}
