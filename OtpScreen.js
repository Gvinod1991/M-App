
import React from 'react';
import {Text, View,TextInputImage ,Image,ScrollView  } from 'react-native';
import { Header,Avatar,Card, ListItem, Button, Icon,SearchBar,FormLabel, FormInput, FormValidationMessage} from 'react-native-elements';
import CodeInput from 'react-native-confirmation-code-input';
export default class OtpScreen extends React.Component {
  static navigationOptions = { header: null }
  _onFulfill(code)
  {
    console.log(code);
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
        codeLength={4}
        activeColor='#aeb0b0'
        inactiveColor='#bfc2c4'
        inputPosition='center'
        onFulfill={(code) => this._onFulfill(code)}
        keyboardType = 'numeric'
      />
      <Text  onPress={() => this.props.navigation.navigate('Home')} style={{textAlign: 'center',fontWeight: 'bold',fontSize: 18,paddingTop:10}}>Resend OTP</Text>
          </ScrollView>
      
      </View>
    );
  }
}



