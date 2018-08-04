
import React from 'react';
import {Text, View,TextInputImage ,Image,ScrollView  } from 'react-native';
import { Header,Avatar,Card, ListItem, Button, Icon,SearchBar,FormLabel, FormInput, FormValidationMessage} from 'react-native-elements'
export default class LoginScreen extends React.Component {
  static navigationOptions = {
    header: null
  };
  state={FormValidationErr:false}
  render() {
    
    console.disableYellowBox = true;
    return (
      <View style={{flex: 1,backgroundColor:'#f5f5f5'}}>
      <Header  outerContainerStyles={{paddingBottom:0}} centerComponent={{ text: 'MY STYLE', style: { color: '#fff' } }}/>
      <Card image={require('./images/banner.jpg')} style={{borderWidth:0.1}} imageStyle={{height:300}} wrapperStyle={{margin:0,padding:0}} containerStyle={{borderWidth:0.5,height:250,margin:0,padding:0}} ></Card>
        <FormLabel labelStyle={{fontSize:18}}>Mobile Number</FormLabel>
        <FormInput keyboardType = 'numeric'inputStyle={{fontSize:16}} />
        <Button 
          icon={<Icon name='code' color='#ffffff' />}
          backgroundColor='#03A9F4'
          buttonStyle={{borderRadius: 0, marginLeft: 0, marginRight: 0, marginBottom: 0}}
          title='Submit' onPress={() => this.props.navigation.navigate('Otp')} />
      </View>
    );
  }
}



