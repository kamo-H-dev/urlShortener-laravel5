# urlShortener-laravel5

#Step-by-step


```
* git clone https://github.com/kamo-dev/urlShortener-laravel5.git

* cd urlShortener-laravel5

* composer install

* Add your configurations inside .env file (add correct values for BASE_URL, SHORT_URL_LENGTH, etc..)

* php artisan migrate

* php artisan serve   (This step will run application in http://localhost:8000 url)


```

* **Please add your url as described below. After finish it please get all list http://localhost:8000/api/url_items and try short_urls in browser. 
If all are working correct you will be redirect according long urls. 
After each redirect functionality you can see we have "redirects" field which incremented.**

#url_items
  
  
**Get api/url_items**
----
* **URL**

  http://localhost:8000/api/url_items

* **Method:**

  `GET`
  
*  **URL Params**

   **Required:**
 

* **Data Params**

  (optional)

* **Success Response:**

  * **Code:** 200 
  
   **Content:** 
   
```json
[
    {
        "id": 1,
        "long_url": "https://www.google.com",
        "short_url": "http://localhost:8000/d-UFMlYD",
        "device_type": "desktop",
        "redirects": 0,
        "created_at": "2018-03-01 13:57:16",
        "updated_at": "2018-03-01 13:57:16"
    },
    {
        "id": 2,
        "long_url": "https://www.bing.com",
        "short_url": "http://localhost:8000/d-JkIDy4",
        "device_type": "desktop",
        "redirects": 0,
        "created_at": "2018-03-01 14:02:50",
        "updated_at": "2018-03-01 14:02:50"
    }
]
```

**Get api/url_items/{id}**
----
* **URL**

  http://localhost:8000/api/url_items/{id}

* **Method:**

  `GET`
  
*  **URL Params**

   **Required:**
 

* **Data Params**

  (optional)

* **Success Response:**

  * **Code:** 200 
  
   **Content:** 
   
```json
{
    "id": 1,
    "long_url": "https://www.google.com",
    "short_url": "http://localhost:8000/d-UFMlYD",
    "device_type": "desktop",
    "redirects": 0,
    "created_at": "2018-03-01 13:57:16",
    "updated_at": "2018-03-01 13:57:16"
}
```

**Post api/url_items**
----
* **URL**

    http://localhost:8000/api/url_items

* **Method:**

  `POST`
  `content-type: application/x-www-form-urlencoded`
  
*  **URL Params**

   **Required:**
 
   `long_url=[string]`   
  

* **Data Params**

    `(optional)`
    
   `device_type=[string]  (desktop, mobile, tablet)`  

* **Success Response:**

  * **Code:** 200 
  
   **Content:** 
   
```json
{
    "long_url": "https://www.google.com",
    "short_url": "http://localhost:8000/d-UFMlYD",
    "device_type": "desktop",
    "updated_at": "2018-03-01 13:57:16",
    "created_at": "2018-03-01 13:57:16",
    "id": 1
}
```
 
* **Error Response:**

  * **Code:** 400 Bad Request 
  
    **Content:** 
    
    ```json
    {
        "long_url": [
            "The long url field is required."
        ]
    }
    ```
    
**Put api/url_items/{id}**
----
* **URL**

    http://localhost:8000/api/url_items/{id}

* **Method:**

  `PUT`
  `content-type: application/x-www-form-urlencoded`
  
*  **URL Params**

   **Required:**

* **Data Params**

    `(optional)`
 
   `long_url=[string]`  
   `short_url=[string]`  
   `device_type=[string]  (desktop, mobile, tablet)`  
   `redirects=[integer]`  

* **Success Response:**

  * **Code:** 200 
  
   **Content:** 
   
```json
{
    "id": 5,
    "long_url": "www.yandex.ru",
    "short_url": "http://localhost:8000/m-4LixJc",
    "device_type": "mobile",
    "redirects": 0,
    "created_at": "2018-03-01 14:03:57",
    "updated_at": "2018-03-01 14:07:13"
}
```
 
* **Error Response:**

  * **Code:** 400 Bad Request 
  
    **Content:** 
    
    ```json
    {
        "status": false,
        "message": "No any changes"
    }
    ```
    
      ```json
       {
           "status": false,
           "message": "Invalid Id"
       }
   ```
   
**Delete api/url_items/{id}**
   ----
   * **URL**
   
       http://localhost:8000/api/url_items/{id}
   
   * **Method:**
   
     `DELETE`
     
   *  **URL Params**
   
      **Required:**
   
   * **Data Params**
   
       `(optional)`
   
   * **Success Response:**
   
     * **Code:** 200 
     
      **Content:** 
      
   ```json
   {
       "status": true,
       "error": ""
   }
   ```
    
   * **Error Response:**
   
     * **Code:** 400 Bad Request 
     
       **Content:** 
       
       ```json
       {
           "status": false,
           "error": "Invalid id for deleting item"
       }
       ```