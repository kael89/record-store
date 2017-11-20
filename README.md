# Record Store

Live website: https://record-store.herokuapp.com

This project is a web site replicating the functionality of a record store library. Users can add, update and delete information about records and artists. The code is written in HTML5/CSS3/JavaScript/PHP.

![alt text](https://user-images.githubusercontent.com/20692464/33021338-9d10cc3c-ce55-11e7-9334-ca5dee42355d.jpg)

## Getting Started

The code for the project is built for live deployment in [Heroku](https://www.heroku.com/), but can also be used in a local [XAMPP](https://www.apachefriends.org/) environment. One can change between the two project modes by simply changing the CODE_ENV constant to "heroku" or "local" respectively. This constant is set in the first lines of `lib/library.php`.

### Prerequisites

#### Heroku
For live deployment as is, you must have a Heroku account. 

You will also need a MySQL/MariaDB database to store your data, since the project uses the MySQLi extension for PHP. The live version of this project uses ClearDB database, integrated for Heroku.

Finally, since Heroku stores file assets such as user uploaded images only temporarily, you will need to have a file storage service. Amazon's AWS S3 was used for the live version of the project.

#### Local
The code for the local version of the project was built to work with XAMPP for Ubuntu Linux, and can serve as a basis for the local environment of your choice. 

### Installing

#### Heroku
* [Deploying a PHP project on Heroku](https://devcenter.heroku.com/articles/getting-started-with-php#introduction)
* [Deploying a MySQL database on a Heroku using ClearDB](https://devcenter.heroku.com/articles/cleardb)
* [Integrating AWS S3 in a Heroku project](https://devcenter.heroku.com/articles/s3)

#### Local
You will need to specify your database credentials to connect with your MySQL/MariaDB database.
In order to achieve this, you can creating a configuration file, and then specify its filepath in the CONFIG_FILE constant defined in the start of `lib/library.php`.

Configuration file template:
```
[database]
user = (your username)
pass = (your password)
database = "record_store"
```

Optionally, you can also run `restore.sh` under `scripts` folder to populate the site with a few records/artists and their respective photos. Note: in order for the script to run succesfully, you must run it from its directory.

## Built With

* [Bootstrap3](http://getbootstrap.com/docs/3.3/)
* [jQuery](https://jquery.com/)
* [Composer](https://getcomposer.org/) - Dependency Management

## Authors

**Kostas Karvounis** - [kael89](https://github.com/kael89)

## License

The code for this project is licensed under the GNU General Public License v3.0 - see the [LICENSE.md](LICENSE.md) file for details

Copyrights of record & band photos belong to their respective owners, and are used for educational reasons
