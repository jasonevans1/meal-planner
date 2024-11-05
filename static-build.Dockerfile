FROM --platform=linux/amd64 dunglas/frankenphp:static-builder

# Copy your app
WORKDIR /go/src/app/dist/app
COPY . .

# Remove the tests and other unneeded files to save space
# Alternatively, add these files to a .dockerignore file
RUN rm -Rf tests/

# Copy .env file
RUN cp .env.example .env
# Change APP_ENV and APP_DEBUG to be production ready
RUN sed -i'' -e 's/^APP_ENV=.*/APP_ENV=production/' -e 's/^APP_DEBUG=.*/APP_DEBUG=true/' .env
RUN sed -i'' -e 's/^APP_URL=.*/APP_URL=https:\/\/jasonevans.xyz/' .env
RUN sed -i'' -e 's/^DB_CONNECTION=.*/DB_CONNECTION=mysql/' .env
RUN sed -i'' -e 's/^DB_HOST=.*/DB_HOST=127.0.0.1/' .env
RUN sed -i'' -e 's/^DB_DATABASE=.*/DB_DATABASE=laravel/' .env
RUN sed -i'' -e 's/^DB_USERNAME=.*/DB_USERNAME=laravel/' .env

# Make other changes to your .env file if needed

# Install the dependencies
RUN composer install --ignore-platform-reqs --no-dev -a

# Build the static binary
WORKDIR /go/src/app/
RUN EMBED=dist/app/ NO_COMPRESS=1 ./build-static.sh
