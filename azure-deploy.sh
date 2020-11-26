RSCE_GRP="NotesGroupWZ"
IMAGE_BACK="wiktorwz/notes_back:latest"
IMAGE_FRONT="wiktorwz/notes_front:latest"

MONGO_USER="root"
MONGO_PASS=".pass.word.!"
MONGO_DBNAME="NotesMongo"
MONGO_PORT="27017"
MONGO_HOST=""
MONGODB_URL=""

PREFIX="1"
APP_MONGO_ID="$PREFIX-notes-app-mongo"
APP_MONGO_HOST=""

APP_FRONT_ID="$PREFIX-notes-app-front"
APP_FRONT_HOST=""

APP_BACK_ID="$PREFIX-notes-app-back"
APP_BACK_HOST=""


# RESOURCE GROUP
az group create --name $RSCE_GRP --location "South Central US"
# MONGO DEPLOY
az container create \
    -g "$RSCE_GRP" \
    --name "$APP_MONGO_ID" \
    --image mongo:latest \
    --cpu 1 \
    --memory 1 \
    --ip-address "Public" \
    --ports 27017 \
    --environment-variables 'MONGO_INITDB_ROOT_USERNAME'="$MONGO_USER" 'MONGO_INITDB_ROOT_PASSWORD'="$MONGO_PASS" 'MONGO_INITDB_DATABASE'="$MONGO_DBNAME"

APP_MONGO_HOST=$(az container show --name "$APP_MONGO_ID" --resource-group "$RSCE_GRP" --query ipAddress.ip)
APP_MONGO_HOST="${APP_MONGO_HOST//\"}"
MONGODB_URL=mongodb://$MONGO_USER:$MONGO_PASS@$APP_MONGO_HOST:$MONGO_PORT


# BACK DEPLOY
az container create \
    -g "$RSCE_GRP" \
    --name "$APP_BACK_ID" \
    --image "$IMAGE_BACK" \
    --cpu 1 \
    --memory 1 \
    --ip-address "Public" \
    --ports 80 \
    --environment-variables 'MONGODB_URL'="$MONGODB_URL" 'MONGODB_DB'="$MONGO_DBNAME"

APP_BACK_HOST=$(az container show --name "$APP_BACK_ID" --resource-group "$RSCE_GRP" --query ipAddress.ip)
APP_BACK_HOST="${APP_BACK_HOST//\"}"


# FRONT DEPLOY
az container create \
    -g "$RSCE_GRP" \
    --name "$APP_FRONT_ID" \
    --image "$IMAGE_FRONT" \
    --cpu 1 \
    --memory 1 \
    --ip-address "Public" \
    --ports 80 \
    --environment-variables 'BACKEND_SERVER'="http://$APP_BACK_HOST"

APP_FRONT_HOST=$(az container show --name "$APP_FRONT_ID" --resource-group "$RSCE_GRP" --query ipAddress.ip)
APP_FRONT_HOST="${APP_FRONT_HOST//\"}"

echo -e "\n\n----------------------------------"
echo "FRONT APP: $APP_FRONT_HOST"
echo "BACK APP: $APP_BACK_HOST"
echo "MONGO APP: $APP_MONGO_HOST"
echo "BACKEND_SERVER: http://$APP_BACK_HOST"
echo -e "\n----------------------------------"
echo "RSCE_GRP: $RSCE_GRP"
echo "APP_PLAN: $APP_PLAN"
echo "IMAGE_BACK: $IMAGE_BACK"
echo "IMAGE_FRONT: $IMAGE_FRONT"
echo -e "\n----------------------------------"
echo "MONGO_USER: $MONGO_USER"
echo "MONGO_PASS: $MONGO_PASS"
echo "MONGO_DBNAME: $MONGO_DBNAME"
echo "MONGO_PORT: $MONGO_PORT"
echo "MONGO_HOST: $MONGO_HOST"
echo "MONGODB_URL: $MONGODB_URL"
echo -e "\n----------------------------------"
echo "APP_MONGO_ID: $APP_MONGO_ID"
echo "APP_MONGO_HOST: $APP_MONGO_HOST"
echo -e "\n----------------------------------"
echo "APP_FRONT_ID: $APP_FRONT_ID"
echo "APP_FRONT_HOST: $APP_FRONT_HOST"
echo -e "\n----------------------------------"
echo "APP_BACK_ID: $APP_BACK_ID"
echo "APP_BACK_HOST: $APP_BACK_HOST"
