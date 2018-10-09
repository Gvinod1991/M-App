import React from 'react';
import {View,StyleSheet,Text,ScrollView} from 'react-native';
import {Icon,Header,Card} from 'react-native-elements';
import BackComponent from '../common/BackComponent';
import LogoComponent from '../common/LogoComponent';
//Support Class 
class Support extends React.Component {
    static navigationOptions = {
      drawerLabel: 'Support',
      drawerIcon: ({ tintColor }) => (
        <Icon
              name={'phone'}
              size={30}
              type="font-awesome"
              color={tintColor}
            />
      ),
    };
  
    render() {
      return (
        <View style={{flex: 1,backgroundColor:'#f5f5f5'}}>
        <Header leftComponent={<BackComponent navigation={this.props.navigation} />} outerContainerStyles={{paddingBottom:10,backgroundColor:'#FFF'}}  centerComponent={<LogoComponent />}/> 
        <ScrollView>
          <Card 
           title="Support"
           titleStyle={{fontSize:26,color:'#FF3B70'}} >
            <View >
              <Text style={{textAlign:'center',fontSize:18}}>For technical support contact us</Text>
              <View style={{flexDirection:'row',justifyContent:'center'}}>
                <Icon name="envelope" type="font-awesome" size={16} />
                <View><Text> support@mystyletech.com </Text></View>
              </View>
              <View style={{flexDirection:'row',justifyContent:'center'}}>
                <Icon name="phone" type="font-awesome" size={16}/>
                <View><Text> +91-7077602330 </Text></View>
                </View>
            </View>
          </Card>
        </ScrollView>
        </View>
      );
    }
  }
  
//Export the module
export default Support;