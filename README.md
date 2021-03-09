# kubernetes. 
this project is part of 42cursus, it was an initiation to the world of network and system adminitration using docker and kubernetes. 
##Goal
the goal was to setup 6 kubernetes containers(Pod)from docker images, two of them were databases MYSQL and InfluxDB. 
the others were containeres with wordpress, phpmyadmin, Grafana, nginx server redirecting to services. 
each of them was in his own kubernetes container, and has it's own service.
wordpress and phpmyadmin get their data from MYSQL container using service name as request to fetch data(the service name http://mysql get resolved to the ip of the container). 
Grafana monitor all the containers using telegraf which was installed in every container, telegraf send metrics to InfluxDB database using service name... then Grafana show it as dashboards
from InfluxDB.  
