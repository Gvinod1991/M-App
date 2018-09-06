
import React from 'react';
import {Text, View,ScrollView  } from 'react-native';
import { Header,Avatar, Divider} from 'react-native-elements';
import LogoComponent from '../common/LogoComponent';

export default class OffersScreen extends React.Component {
  static navigationOptions = { header: null }
  render() {
    console.disableYellowBox = true;
    return (
      <View style={{flex: 1,backgroundColor:'#f5f5f5'}}>
      <Header outerContainerStyles={{paddingBottom:10,backgroundColor:'#FFEB3B'}}  centerComponent={<LogoComponent />}  /> 
    
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
