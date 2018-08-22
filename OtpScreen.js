
import React from 'react';
import {Text, View,TextInputImage ,Image,ScrollView,AsyncStorage } from 'react-native';
import { Header,Avatar,Card, ListItem, Button, Icon,SearchBar,FormLabel, FormInput, FormValidationMessage} from 'react-native-elements';
import CodeInput from 'react-native-confirmation-code-input';
export default class OtpScreen extends React.Component {
  static navigationOptions = { header: null }
  constructor(props) {
  super(props);
    this.state={
      error:""
    }
    }
  _checkOtp(code)
  {
      const url="http://192.168.43.51/my-style-app/api/public-user/activate";
        fetch(url, {
          method: 'POST',
          headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            otp: code,
            otp_session_key:this.props.navigation.state.params.otp_session_key
          }),
        }).then((response) => response.json())
          .then((responseJson) => {
            if(responseJson.status==1)
            {
              AsyncStorage.setItem('userToken',responseJson.auth_token);
              this.setState({"error":""})
              this.props.navigation.navigate('Home');
            }
            else
            {
              this.setState({"error":responseJson.message})
              this.props.navigation.navigate('Otp');
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
      <Header  outerContainerStyles={{paddingBottom:0}} centerComponent={{ text: 'MY STYLE', style: { color: '#fff' } }}/>
      <ScrollView>
      <Card image={require('./images/banner.jpg')} style={{borderWidth:0.1}} imageStyle={{height:300}} wrapperStyle={{margin:0,padding:0}} containerStyle={{borderWidth:0.5,height:250,margin:0,padding:0}} ></Card>
        <FormLabel labelStyle={{fontSize:18}}>Enter your OTP</FormLabel>
        <CodeInput
        ref="codeInputRef1"
        secureTextEntry
        className={'border-b'}
        space={10}
        size={50}
        codeLength={6}
        activeColor='#aeb0b0'
        inactiveColor='#bfc2c4'
        inputPosition='center'
        onFulfill={(code) => this._checkOtp(code)}
        keyboardType = 'numeric'
      />
      <Text  onPress={() => this.props.navigation.navigate('Home')} style={{textAlign: 'center',fontWeight: 'bold',fontSize: 18,paddingTop:10}}>Resend OTP</Text>
      <Text >{this.state.error}</Text>
         
          </ScrollView>
      
      </View>
    );
  }
}



