import React from 'react';
import {
  ActivityIndicator,
  AsyncStorage,
  StatusBar,
  StyleSheet,
  View,Modal
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
                <ActivityIndicator size="large" 
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
      backgroundColor: '#00000040'
    },
    activityIndicatorWrapper: {
      backgroundColor: '#FFFFFF',
      height: 100,
      width: 100,
      borderRadius: 10,
      display: 'flex',
      alignItems: 'center',
      justifyContent: 'space-around'
    }
  });

  //Export the module
  export default Loader;
  