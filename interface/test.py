
from driver import driver

def main():
    x = driver("Breast", False, "G:/Senior Project/dataset/Breast/prepared/train/0/8863_idx5_x151_y1301_class0.png")
    print("Value x returned from driver : ")
    print(x)

    #y = driver("Breast", False, "G:/Senior Project/dataset/Breast/prepared/train/1/16896_idx5_x751_y1551_class1.png")
    #print("Value y returned from driver : ")
    #print(y)

if __name__ == "__main__":
    main()