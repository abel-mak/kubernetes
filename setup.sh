rm -rf ~/goinfre/.minikube/
mkdir ~/goinfre/.minikube/
#mkdir ~/goinfre/.docker/
ln -s ~/goinfre/.minikube/ ~/.minkube
#ln -s ~/goinfre/.docker/ ~/.docker

if [ "$(which minikube)" != "" ]
then
	echo "minkube already installed ✅"
else
	echo "Installing minikube..."
	brew install minikube > /dev/null
	if [ "$(which minikube)" != "" ]
	then
		echo "minikube intalled ✅"
	fi
fi

if [ "$(which docker)" != "" ]
then
	echo "docker already installed ✅"
else
	echo "Installing docker cli..."
	brew install docker > /dev/null
	if [ "$(which docker)" != "" ]
	then
		echo "docker installed ✅"
	fi
fi

minikube start --cpus 2 --memory 4000
eval $(minikube docker-env)
minikube addons enable metallb
kubectl apply -f srcs/config.yaml 

kubectl apply -f srcs/service-ftps.yaml
kubectl apply -f srcs/service-grafana.yaml
kubectl apply -f srcs/service-influx.yaml
kubectl apply -f srcs/service-mysql.yaml
kubectl apply -f srcs/service-phpmyadmin.yaml
kubectl apply -f srcs/service-wordpress.yaml
kubectl apply -f srcs/service-nginx.yaml
sleep 40
kubectl apply -f srcs/pv-mysql.yaml 
kubectl apply -f srcs/pv-influx.yaml

#tr -s " " will replace all whitespaces with one so it's easy to cut
docker build --build-arg FTPS_IP=$(kubectl get svc | tr -s " " | grep ftps \
| cut -d " " -f 4) srcs/ftps-docker/ -t ftps-docker
docker build --build-arg IP=$(kubectl get svc | tr -s " " | grep phpmyadmin | \
 cut -d " " -f 4) srcs/nginx-docker -t nginx-docker
docker build srcs/grafana-docker/ -t grafana-docker
docker build srcs/influx-docker/ -t influx-docker
docker build srcs/mysql-docker/ -t mysql-docker
docker build srcs/phpmyadmin-docker/ -t phpmyadmin-docker
docker build srcs/wordpress-docker/ -t wordpress-docker


kubectl apply -f srcs/deployment-ftps.yaml 
kubectl apply -f srcs/deployment-grafana.yaml
kubectl apply -f srcs/deployment-influx.yaml
kubectl apply -f srcs/deployment-mysql.yaml
kubectl apply -f srcs/deployment-phpmyadmin.yaml
kubectl apply -f srcs/deployment-wordpress.yaml
kubectl apply -f srcs/deployment-nginx.yaml
minikube dashboard
