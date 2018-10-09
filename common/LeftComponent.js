import React from 'react';
import {View,StyleSheet} from 'react-native';
import {Icon} from 'react-native-elements';

class LeftComponent extends React.Component {
   
    constructor(props){
      super(props);
      this.state={
      }
    }
    render() {
        return (
          <View style={{ flex: 1,justifyContent:'center',alignItems:'center'}}>
            <Icon style={{justifyContent:'center',alignItems:'center',marginTop:10}} color="#FF3B70" name="menu" size={32} onPress={() => this.props.navigation.openDrawer()}/>  
          </View>
        );
    }
}
//
const styles = StyleSheet.create({

});

//Export the module
export default LeftComponent;