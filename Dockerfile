FROM php:7.0-alpine
COPY . /app
VOLUME /app
EXPOSE 3000
WORKDIR /app
HEALTHCHECK --interval=10s --timeout=10s CMD curl -f http://localhost:3000/ || exit 1
CMD ["php", "-S", "0.0.0.0:3000", "-t", "/app"]
