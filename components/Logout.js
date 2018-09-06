
import React from 'react';
import {Text, View} from 'react-native';
import { Icon} from 'react-native-elements';
export default class Logout extends React.Component {
  static navigationOptions = { header: null }
  
  render() {
    console.disableYellowBox = true;
    //const {navigate}=this.props.navigation;  
    return (
       <View>
        <Icon  onPress={() => this.props.navigate('Login')}
            name='launch'
            color='#ffff' />
      </View>  
    );
  } 
}



