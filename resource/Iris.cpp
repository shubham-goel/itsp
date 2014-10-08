#include "opencv2/imgproc/imgproc.hpp"
#include "opencv2/highgui/highgui.hpp"
#include <stdlib.h>
#include <stdio.h>

using namespace cv;
using namespace std;

int main(){

	// load Iris Image
	Mat orig;
	orig = imread("test.jpg",1);
	namedWindow("Input Image", CV_WINDOW_AUTOSIZE);
	imshow("Input Image", orig);

	blur(orig,orig,Size( 3, 3 ), Point(-1,-1));
	// Thresholding

	Mat thresh;
	threshold( orig, thresh, 90,255,1 );
	namedWindow("Threshold",CV_WINDOW_AUTOSIZE);
	imshow("Threshold",thresh);

	// I want to detect pupil and hence I need median filtering here
	 Mat final1;
	namedWindow("output1",CV_WINDOW_AUTOSIZE);
	medianBlur(thresh,final1,21);
	imshow("output1",final1);

	// Now we have an isolated pupil, now we need to detect the IRIS by canny edge detection.

	//canny()

	waitKey(0);
	return 0;

}