
import React from 'react';
import {Text, View,TextInputImage ,Image,ScrollView  } from 'react-native';
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
    submit = () => {
      // Function body
      if(this.state.phone=="" || this.state.phone.length!=10)
      {
        this.setState({error:true});
        this.setState({errorMessage:"Mobile is required"});
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
            underlineColorAndroid="#ccc" shake={this.state.error ? false : true} 
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
