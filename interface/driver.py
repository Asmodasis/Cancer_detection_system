
import numpy as np
import tensorflow as tf
from tensorflow import keras
from tensorflow.keras.models import Sequential 
from tensorflow.keras.preprocessing import image

#This function will require that Unix directory naming convention is applied, Directories start with a capital letter

def driver(whatOrgan, isSemantic, img):
    
    img_width = 200
    img_height = 200 

    im = image.load_img(img, target_size=(img_width, img_height))
    x = image.img_to_array(im)
    x = np.expand_dims(x, axis=0)

    images = np.vstack([x])

    if(isSemantic):                                     # If it is semantic, the semantic network will be run
        file = '../'+whatOrgan+'/'+whatOrgan+'_Model_Semantic.h5'
        
        model = tf.keras.models.load_model(file)        # Load the model

        return model.predict_classes(images)   
    else:                                               # Else a normal network will be applied
        file = '../'+whatOrgan+'/'+whatOrgan+'_Model.h5'
        
        model = tf.keras.models.load_model(file)        # Load the model

        return int(str(model.predict_classes(images)).strip('[').strip(']'))             

    