# outdoor-trails-master
Master repo for ABQ outdoor trails app

## Database Identification:
For bike trails we will use a CSV file (BikePaths.csv) which has details about path coordinates, path type, direction(east to west, etc), posted speed limits(for bike lanes on roads), surface type, and other details.  We think this will be enough data to work with.

## Actual Route Creation
One option looks like using Google Maps and Google Routes, but I think we will have to pay to use Routes.
LeafletJS has <Path /> and <Polyline /> components that look like they will allow us to pass in coordinates and connect a line.
John was also able to display route lines using the kml file from cabq and gpsvisualizer.com

Either of these two tools should allow us to construct maps with our routes. 