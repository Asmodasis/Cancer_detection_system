
#This function will require that Unix directory naming convention is applied, Directories start with a capital letter

def driver(whatOrgan, isSemantic, image):
    import numpy as np
    import tensorflow as tf
    from tensorflow import keras

    if(isSemantic):                                     # If it is semantic, the semantic network will be run
        file = '../'+whatOrgan+'/'+whatOrgan+'_Model_Semantic.h5'
        
        model = tf.keras.models.load_model(file)        # Load the model

        return model.predict_class(image)   
    else:                                               # Else a normal network will be applied
        file = '../'+whatOrgan+'/'+whatOrgan+'_Model.h5'
        
        model = tf.keras.models.load_model(file)        # Load the model

        return int(str(model.predict_class(image)).strip('[').strip(']'))             

    