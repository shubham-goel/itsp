
#include <iostream>
#include "opencv2/highgui/highgui.hpp"
#include "opencv2/imgproc/imgproc.hpp"

using namespace std;
using namespace cv;

int main(){

  int LastX = -1,LastY = -1;

	VideoCapture cap(1); //capture the video from webcam

    if ( !cap.isOpened() )  // if not success, exit program
    {
         cout << "Cannot open the web cam" << endl;
         return -1;
    }

    Mat frametemp;
    cap.read(frametemp); 
    Mat imgLines = Mat::zeros( frametemp.size(), CV_8UC3 );

    while(1){

    	Mat frame;
    	bool Success = cap.read(frame); // read a new frame from video

         if (!Success) //if not success, break loop
        {
             cout << "Cannot read a frame from video stream" << endl;
             break;
        }
        namedWindow("Cameraoutput",CV_WINDOW_AUTOSIZE);
        imshow("Cameraoutput",frame);

        Mat imghsv,imgThresholded;

      cvtColor(frame,imghsv,CV_BGR2HSV);
      blur(imghsv,imghsv,Size(3,3),Point(-1,-1));
   		inRange(imghsv, Scalar(160, 50, 68), Scalar(180, 256, 248), imgThresholded); //Threshold the image     
   		
   		namedWindow("Threshold",CV_WINDOW_AUTOSIZE);
   		imshow("Threshold",imgThresholded);

    Moments mu = moments(imgThresholded);

      double area = mu.m00;
      double x = mu.m10;
      double y = mu.m01;
      
      if(area>200){
          int posX = x/area;
          int posY = y/area; 

          if (LastX >= 0 && LastY >= 0 && posX >= 0 && posY >= 0)
          {
         // Draw a red line from the previous point to the current point
           line(imgLines, Point(posX, posY), Point(LastX, LastY), Scalar(0,0,255), 2);
          }

          LastX = posX;
          LastY = posY;
      }

     Mat imgfinal = frame + imgLines;
     namedWindow("Output",CV_WINDOW_AUTOSIZE);
     imshow("Output",imgLines);

         if (waitKey(100) == 27) //wait for 'esc' key press for 100ms. If 'esc' key is pressed, break loop
       {
            cout << "esc key is pressed by user" << endl;
            break; 
       }
    }
    
    return 0;
}
