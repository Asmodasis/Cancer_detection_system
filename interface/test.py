
from driver import driver

def main():
    x = driver("Breast", False, "G:/Senior Project/dataset/Breast/prepared/train/0/8863_idx5_x151_y1301_class0.png")
    print("Value returned from driver : ")
    print(x)

if __name__ == "__main__":
    main()