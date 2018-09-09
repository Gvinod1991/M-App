import React from 'react';
import {
  ActivityIndicator,
  AsyncStorage,
  StatusBar,
  StyleSheet,
  View,Modal,Dimensions,Overlay
} from 'react-native';
const Loader = props => {
    const {
      loading,
      ...attributes
    } = props;

  // Render any loading content that you like her
    return (
        <Modal
            onRequestClose={()=>{}}
            transparent={true}
            animationType={'none'}
            visible={loading}>
            <View style={styles.modalBackground}>
            <View style={styles.activityIndicatorWrapper}>
                <ActivityIndicator color="#FF3B70"  size="large" 
                animating={loading} />
            </View>
            
            </View>
        </Modal>
    );
}
const styles = StyleSheet.create({
    modalBackground: {
      flex: 1,
      alignItems: 'center',
      flexDirection: 'column',
      justifyContent: 'space-around',
      backgroundColor: '#00000040',
    },
    activityIndicatorWrapper: {
      backgroundColor: '#FFFFFF',
      height: 50,
      width:Dimensions.get('window').width-30,
      display: 'flex',
      alignItems: 'center',
      justifyContent: 'space-around',
      elevation:5,
      shadowOffset: { width: 10, height: 10 },
      shadowColor: "grey",
      shadowOpacity: 0.5,
      shadowRadius: 10,
    }
  });

  //Export the module
  export default Loader;
  