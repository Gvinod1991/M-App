
import React from 'react';
import {TouchableHighlight,Text, View,TextInputImage ,Image,ScrollView,AsyncStorage  } from 'react-native';
import { Header,Avatar,Card, Divider, Button, Icon,SearchBar,FormLabel, FormInput, FormValidationMessage} from 'react-native-elements';
import Logout from './Logout';
export default class ProfileScreen extends React.Component {
  static navigationOptions = { header: null };
  constructor(props) {
    super(props);
    this.state = {
      phone: '',
      email_id:'email@youremailserver.com',
      name:'Your Name',
      location:'Your Location/Address',
      profile:'https://s3.amazonaws.com/uifaces/faces/twitter/kfriedson/128.jpg',
      viewMode:true,
      editMode:false
      };
      this._retrieveuserToken();
    }
    //To retrive user Token from asyncstorage
    _retrieveuserToken = async () => {
      try {
        const userToken = await AsyncStorage.getItem('userToken');
        if (userToken !== null) {
          // We have data!!
          this.getUserDetails(userToken);
        }
       } catch (error) {
         // Error retrieving data
       }
    }
    //Function to get the user details
    getUserDetails = (userToken) => {
        const url="http://192.168.43.51/my-style-app/api/public-user";
        fetch(url, {
          method: 'GET',
          headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json',
            'Authorization': 'Bearer '+userToken
          }
        }).then((response) => response.json())
          .then((responseJson) => {
            if(responseJson.status===1)
            {
              this.setState({ phone: responseJson.public_user.mobile,
              email_id:responseJson.public_user.email_id,
              name:responseJson.public_user.name,
              location:responseJson.public_user.location
              });
            }
            else
            {
             console.log(responseJson);
            }
          })
          .catch((error) => {
            console.error(error);
          });
     
    }
    //to handle state of the user inputs
    handleChange(value,name) {
      this.setState({name: value})//dynamically set the state
      }
    //function to edit user
    editUser=()=>{
        this.setState({'viewMode':false});
        this.setState({'editMode':true});
    };
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
                    source={{uri: this.state.profile}}
                    onPress={() => console.log("Works!")}
                    activeOpacity={0.7}
                    style={{padding:30}}
                />
                </View>
                {this.state.viewMode && <View>
                <View style={{flexDirection:'row',justifyContent:'space-between',border:'#f5f5f5',padding:5,backgroundColor:'#fff'}}>
                 <Text style={{fontSize:20,padding:5}}>{this.state.name}</Text>
                 <Icon style={{fontSize:20,padding:5}} name="pencil" onPress={() => this.editUser()} color="#ccc"  type="font-awesome"/>
                </View>
                <View style={{border:'#f5f5f5',padding:5,backgroundColor:'#fff'}}>
                 <Text style={{fontSize:18,padding:5}}>About and contact</Text>
                 <View style={{flexDirection:'row'}}>
                 <Icon name="phone" color="#ccc" type="font-awesome"/>
                 <Text style={{fontSize:16,padding:20}}>+91-{this.state.phone}</Text>
                 </View>
                 <Divider style={{ backgroundColor: '#ccc' }} />
                 <View style={{flexDirection:'row'}}>
                 <Icon name="envelope" color="#ccc" type="font-awesome"/>
                 <Text style={{fontSize:16,padding:20}}>{this.state.email_id}</Text>
                 </View>
                 <Divider style={{ backgroundColor: '#ccc' }} />
                 <View style={{flexDirection:'row'}}>
                 <Icon name="map-marker" color="#ccc" type="font-awesome"/>
                 <Text style={{fontSize:16,padding:20}}>{this.state.location}</Text>
                 </View>
                </View>
                </View>
                }
                {this.state.editMode && <View>
                  <FormLabel labelStyle={{fontSize:18}}>Mobile Number</FormLabel>
                  <FormInput 
                    underlineColorAndroid="#ccc" name="name" shake={this.state.error} 
                      onChangeText={e => this.handleChange(e,'name')} 
                    value={this.state.name} inputStyle={{fontSize:18}} />
                    { this.state.error && 
                      <FormValidationMessage >{this.state.errorMessage}</FormValidationMessage>
                    }
                  <FormLabel labelStyle={{fontSize:18}}>Email Id</FormLabel>
                  <FormInput 
                    underlineColorAndroid="#ccc" name="email_id" shake={this.state.error} 
                      onChangeText={e => this.handleChange(e,'email_id')} 
                    value={this.state.email_id} inputStyle={{fontSize:18}} />
                    { this.state.error && 
                      <FormValidationMessage >{this.state.errorMessage}</FormValidationMessage>
                    }
                  <FormInput 
                    underlineColorAndroid="#ccc" name="location" shake={this.state.error} 
                      onChangeText={e => this.handleChange(e,'location')} 
                    value={this.state.location} inputStyle={{fontSize:18}} />
                    { this.state.error && 
                      <FormValidationMessage >{this.state.errorMessage}</FormValidationMessage>
                    }
                  <Button 
                    icon={<Icon name='code' color='#ffffff' />}
                    backgroundColor='#03A9F4'
                    buttonStyle={{borderRadius: 0, marginLeft: 0, marginRight: 0, marginBottom: 0}}
                    title='Submit' onPress={() => this.submit()} />
          
                </View>
                }
            </View>
      </ScrollView>      
      </View>
    );
  }
}
