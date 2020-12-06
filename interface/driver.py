
import numpy as np
import tensorflow as tf
from tensorflow import keras
from tensorflow.keras.models import Sequential 
from tensorflow.keras.preprocessing import image
import sys

#This function will require that Unix directory naming convention is applied, Directories start with a capital letter

whatOrgan   = sys.argv[1]                               # The organ will be the first argument passed to the function
isSemantic  = sys.argv[2]                               # The boolean value determining whether it is a semantic network
img         = sys.argv[3]                               # The location of the image to be processed
#TODO: No error handling regarding the organ and image in question.

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

    