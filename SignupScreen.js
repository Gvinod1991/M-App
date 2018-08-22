import React from 'react';
import {Text, View,TextInputImage ,Image,ScrollView,AsyncStorage  } from 'react-native';
import { Header,Avatar,Card, ListItem, Button, Icon,SearchBar,FormLabel, FormInput, FormValidationMessage} from 'react-native-elements'
export default class SignupScreen extends React.Component {
  static navigationOptions = {
    header: null
  };
  constructor(props) {
    
      super(props);
      this.state = {
        phone: '',
        };
      } 
  handleChange(phone) {
    this.setState({phone: phone})
    }
    //Function to sign up the user
    submit = () => {
      // Function body
      if(this.state.phone=="" || this.state.phone.length!=10)
      {
        this.setState({error:true});
        this.setState({errorMessage:"Mobile is required & should be 10 digits "});
      }
      else
      {
        this.setState({error:false});
        this.setState({errorMessage:""});
        const url="http://192.168.43.51/my-style-app/api/public-user";
        fetch(url, {
          method: 'POST',
          headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            mobile: this.state.phone
          }),
        }).then((response) => response.json())
          .then((responseJson) => {
            if(responseJson.data.status==='new')
            {
              AsyncStorage.setItem('userToken',responseJson.data.auth_token);
              this.props.navigation.navigate('Otp',{
                otp_session_key: responseJson.data.otp_session_key,
                mobile: this.state.phone
              });
            }
            else
            {
              AsyncStorage.setItem('userToken',responseJson.data.auth_token);
              this.props.navigation.navigate('Home');
            }
          })
          .catch((error) => {
            console.error(error);
          });
      }
     
    }
 render() {
    
    console.disableYellowBox = true;
    return (
      <View style={{flex: 1,backgroundColor:'#f5f5f5'}}>
        <Header  outerContainerStyles={{paddingBottom:0}} 
            centerComponent={{ text: 'MY STYLE', style: { color: '#fff' } }}/>
        <ScrollView>
          <Card image={require('./images/banner.jpg')} 
            style={{borderWidth:0.1}} 
            imageStyle={{height:300}} 
            wrapperStyle={{margin:0,padding:0}} 
            containerStyle={{borderWidth:0.5,height:250,margin:0,padding:0}} >
          </Card>
          
          <FormLabel labelStyle={{fontSize:18}}>Mobile Number</FormLabel>
          <FormInput 
            underlineColorAndroid="#ccc" shake={this.state.error} 
            keyboardType = 'numeric' onChangeText={e => this.handleChange(e)} 
            value={this.state.phone} inputStyle={{fontSize:18}} />
            { this.state.error && 
              <FormValidationMessage >{this.state.errorMessage}</FormValidationMessage>
            }
          <Button 
            icon={<Icon name='code' color='#ffffff' />}
            backgroundColor='#03A9F4'
            buttonStyle={{borderRadius: 0, marginLeft: 0, marginRight: 0, marginBottom: 0}}
            title='Submit' onPress={() => this.submit()} />
          
          </ScrollView>
      </View>
    );
  }
}
