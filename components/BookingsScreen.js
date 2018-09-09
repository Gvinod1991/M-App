
import React from 'react';
import {Text, View,ScrollView  } from 'react-native';
import { Header, Divider, Icon} from 'react-native-elements';
import LogoComponent from '../common/LogoComponent';
export default class BookingsScreen extends React.Component {
  static navigationOptions = { header: null }
  render() {
    console.disableYellowBox = true;
    return (
      <View style={{flex: 1,backgroundColor:'#f5f5f5'}}>
      <Header outerContainerStyles={{paddingBottom:10,backgroundColor:'#FFF'}}  centerComponent={<LogoComponent />}  />
      <ScrollView>
            <View style={{paddingTop:30,padding:5,backgroundColor:'#f5f5f5'}}>
            <Text style={{padding:5}}>Bookings</Text>
                <View style={{flexDirection:'row',justifyContent:'space-between',padding:5,backgroundColor:'#fff'}}>
                 <Text >Date</Text>
                 <Text >Service</Text>
                 <Text >Saloon</Text>
                 <Text >Action</Text>
                </View>
                <Divider style={{ backgroundColor: '#ccc' }} />
                <View style={{flexDirection:'row',justifyContent:'space-between',padding:20,backgroundColor:'#fff'}}>
                 <Text >01-08-2018</Text>
                 <Text >Service 1</Text>
                 <Text >Saloon 1</Text>
                 <Icon name="eye" color="#ccc" type="font-awesome"/>
                </View>
                <Divider style={{ backgroundColor: '#ccc' }} />
                <View style={{flexDirection:'row',justifyContent:'space-between',padding:20,backgroundColor:'#fff'}}>
                 <Text >01-08-2018</Text>
                 <Text >Service 1</Text>
                 <Text >Saloon 1</Text>
                 <Icon name="eye" color="#ccc" type="font-awesome"/>
                </View>
                <Divider style={{ backgroundColor: '#ccc' }} />
                <View style={{flexDirection:'row',justifyContent:'space-between',padding:20,backgroundColor:'#fff'}}>
                 <Text >01-08-2018</Text>
                 <Text >Service 1</Text>
                 <Text >Saloon 1</Text>
                 <Icon name="eye" color="#ccc" type="font-awesome"/>
                </View>
                <Divider style={{ backgroundColor: '#ccc' }} />
                <View style={{flexDirection:'row',justifyContent:'space-between',padding:20,backgroundColor:'#fff'}}>
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
