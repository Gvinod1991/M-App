
import React from 'react';
import {TouchableHighlight,Text, View,TextInputImage ,Image,ScrollView,AsyncStorage,KeyboardAvoidingView  } from 'react-native';
import { Header,Avatar,Card, Divider, Button, Icon,SearchBar,FormLabel, FormInput, FormValidationMessage} from 'react-native-elements';
import Logout from './Logout';
import { ImagePicker } from 'expo';
export default class ProfileScreen extends React.Component {
  static navigationOptions = { header: null };
  constructor(props) {
    super(props);
    this.state = {
      phone: '',
      email_id:'email@youremailserver.com',
      name:'Your Name',
      location:'Your Location/Address',
      profile:'http://192.168.43.51/my-style-app/public/uploads/profile.png',
      viewMode:true,
      editMode:false,
      userToken:'',
      image: null
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
          this.setState({ userToken: userToken})
        }
       } catch (error) {
         // Error retrieving data
       }
    }
    //Function to get the user details
    getUserDetails = (userToken) => {
        const url="http://192.168.43.51/my-style-app/api/public-user";
        const image_api_url='http://192.168.43.51/my-style-app/public';
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
              location:responseJson.public_user.location,
              });
              if(responseJson.public_user.profile!="")
              {
                console.log(image_api_url+'/'+responseJson.public_user.profile);
                this.setState({ profile: image_api_url+'/'+responseJson.public_user.profile});
              }
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
      this.setState({[name]: value})//dynamically set the state
      }
    //function to edit user
    editUser=()=>{
        this.setState({'viewMode':false});
        this.setState({'editMode':true});
    };
    //Submit the Form and Update user details
    submit=()=>{
      const emailRegex=/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          if(this.state.name=='' || this.state.name==undefined)
          {
            this.setState({errorName:"Name is required"});
            return false;
          }
          if(this.state.email_id=='' || this.state.name==undefined || !emailRegex.test(this.state.email_id))
          {
            this.setState({errorEmail:"Valid email id is required"});
            return false;
          }
          if(this.state.location=='' || this.state.location==undefined)
          {
            this.setState({errorLocation:"Your location/address is required"});
            return false;
          }
          this.setState({errorName:false});
          this.setState({errorEmail:false});
          this.setState({errorLocation:false});
        const url="http://192.168.43.51/my-style-app/api/public-user";
        fetch(url, {
          method: 'PUT',
          headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json',
            'Authorization': 'Bearer '+this.state.userToken
          },
          body: JSON.stringify({
            name: this.state.name,
            email_id: this.state.email_id,
            location: this.state.location
          }),
        }).then((response) => response.json())
          .then((responseJson) => {
            console.log(responseJson);
            if(responseJson.status==1)
            {
              this.setState({'viewMode':true});
              this.setState({'editMode':false});
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
  _pickImage= async () => {
    const url="http://192.168.43.51/my-style-app/api/public-user/upload-profile";
    let result = await ImagePicker.launchImageLibraryAsync({
      allowsEditing: true,
      aspect: [4, 3],
    });
    if (!result.cancelled) {
      this.setState({ profile: result.uri });
      let formData = new FormData();
      formData.append('profileFile', {
        uri:result.uri,
        name: 'profile.jpg',
        type:'image/jpg',
        filename :'profile.jpg'
      });
      fetch('http://192.168.43.51/my-style-app/api/public-user/upload-profile', {
        method: 'POST',
        body: formData,
        headers: {
          Accept: 'application/json',
          'Content-Type': 'multipart/form-data',
          //'Content-Language': React.NativeModules.RNI18n.locale,
          'Authorization': 'Bearer '+this.state.userToken
        },
      }).then((response) => response.json())
        .then((responseJson) => {
          console.log(responseJson);
        })
        .catch((error) => {
          console.log(error);
        });
    }
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
                {this.state.profile &&
                <Avatar
                    xlarge
                    rounded
                    source={{uri: this.state.profile}}
                    onTouchStart={() => this._pickImage()}
                    activeOpacity={0.7}
                    style={{padding:30}}
                />
                }
                </View>
            
                {this.state.viewMode && <View>
                <View style={{flexDirection:'row',justifyContent:'space-between',padding:5,backgroundColor:'#fff'}}>
                 <Text style={{fontSize:20,padding:5}}>{this.state.name}</Text>
                 <Icon style={{fontSize:20,padding:5}} name="pencil" onPress={() => this.editUser()} color="#ccc"  type="font-awesome"/>
                </View>
                <View style={{padding:5,backgroundColor:'#fff'}}>
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
                {this.state.editMode && <KeyboardAvoidingView><View>
                  <FormLabel labelStyle={{fontSize:18}}>Name</FormLabel>
                  <FormInput 
                    underlineColorAndroid="#ccc" name="name" shake={this.state.error} 
                      onChangeText={e => this.handleChange(e,'name')} 
                    value={this.state.name} inputStyle={{fontSize:18}} />
                    { this.state.errorName && 
                      <FormValidationMessage >{this.state.errorName}</FormValidationMessage>
                    }
                  <FormLabel labelStyle={{fontSize:18}}>Email Id</FormLabel>
                  <FormInput 
                    underlineColorAndroid="#ccc" name="email_id" shake={this.state.error} 
                      onChangeText={e => this.handleChange(e,'email_id')} 
                    value={this.state.email_id} inputStyle={{fontSize:18}} />
                    { this.state.errorEmail && 
                      <FormValidationMessage >{this.state.errorEmail}</FormValidationMessage>
                    }
                  <FormLabel labelStyle={{fontSize:18}}>Location</FormLabel>
                  <FormInput 
                    underlineColorAndroid="#ccc" name="location" shake={this.state.error} 
                      onChangeText={e => this.handleChange(e,'location')} 
                    value={this.state.location} inputStyle={{fontSize:18}} />
                    { this.state.errorLocation && 
                      <FormValidationMessage >{this.state.errorLocation}</FormValidationMessage>
                    }
                  <Button 
                    icon={<Icon name='code' color='#ffffff' />}
                    backgroundColor='#03A9F4'
                    buttonStyle={{borderRadius: 0, marginLeft: 0, marginRight: 0, marginBottom: 0}}
                    title='Update' onPress={() => this.submit()} />
          
                </View>
                <View style={{ height: 150 }} />
                </KeyboardAvoidingView>
                }
                 
            </View>   
            </ScrollView>   
      </View>
    );
  }
}
