# Intro
You cannot directly build on UWCS as that is too CPU intensive
So it is circumvented by building the docker image separately on a local machine and pushing it to the registry
Instructions to do this are below

# Building docker container and pushing it to registry
- Build the docker container
```
docker compose build
```
- Check the images with:
```
docker images
```
- Tag to that repo:
```
docker tag laravel-wvs-app:latest vocaloidsoc/laravel_vite_app:latest
```
- Login (username is vocaloidsoc, password is the usual one)
```
docker tag laravel-wvs-app:latest vocaloidsoc/laravel_vite_app:latest
```
- Finally push
```
docker push vocaloidsoc/laravel_vite_app:latest
```

# Running on UWCS
- Then make sure the latest version of the image has been loaded
- Use custom template on account to deploy
- There might be issues with the network and NGINX and stack causing a 502 error after you have deployed, you'll have to ask the UWCS #tech-team on Discord to fix that
