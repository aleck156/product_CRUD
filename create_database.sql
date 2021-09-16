DROP DATABASE IF EXISTS products_crud;

CREATE DATABASE products_crud;

CREATE TABLE products (
  id            INT NOT NULL AUTO_INCREMENT,
  title         VARCHAR(255) NOT NULL,
  description   LONGTEXT,
  image         VARCHAR(2048),
  price         DECIMAL(10,2) NOT NULL,
  create_date   DATETIME NOT NULL,
  PRIMARY KEY(id)
);