# my-lucky-star: an exercise to learn Symfony.

After I learned PHP and the OOP, I wanted to learn to code with my first framework. 
Symfony seemed to be the best choice as many developers gave me a great return.

## The main goal to this exercise:
Create a full CRUD website with a SQL database, routes and templates in twig.

The style was once again not my first priority, so I mainly used bootstrap to go faster and have a responsive finish.

As always, I trained myself with a subject which I love: Astronomy and more precisely: science fiction.
The website is a dystopic website made to buy and sell stars.
Of course, this is not a real project.

### Home:

![Capture](https://github.com/Nicolas-CHRETIEN/my-lucky-star/assets/132827127/006a7a3a-7c59-47f4-818d-64c1f02a08a9)


The home page can be reach by any user. 
It contains some information about stars and the universe to simulate a real marketing website with information on the products.

The home page is the only page you can access without register with the stars page which contains the products and the register page.

### A restricted access:

![register](https://github.com/Nicolas-CHRETIEN/my-lucky-star/assets/132827127/a0b34368-4f9a-41c5-8de2-5c4be8041a59)

If you're not registered you can't access to many functionalities:
  - You can't comment a product, or answer to a comment
  - You can't create a star
  - You can't of course access to your account page with all your information.

There are three types of users:
  - the not registered users, as explained above
  - the normal users: they can create a star, modify stars they created, add a comment and answer to a comment or delete a comment they created.
  - the admin: They can do everything: delete/update any star, delete any comment.


### The products:

![stars-filters](https://github.com/Nicolas-CHRETIEN/my-lucky-star/assets/132827127/b9780559-8f55-487f-9008-5b83f3538be4)


Here products are real stars.
They are displayed in the shape of cards. You can have further information on the product if you click on the card.
You have on the left side several filters to select the type of product you want.

As I created a lot of data for this website, I let the possibility to show only 10 results per page by creating a pagination system:

![stars-pagination](https://github.com/Nicolas-CHRETIEN/my-lucky-star/assets/132827127/2db74794-9875-4b77-9a15-223ed1f8bca6)


### The creation / update:


![stars-create-update-star](https://github.com/Nicolas-CHRETIEN/my-lucky-star/assets/132827127/0549970e-cfa7-4d28-ad10-b637acd43622)


If you have the access, you can create or update a star.
I created a form to collect data and adding it to the database.
If you update the star, the current information are indicated by default.


### Product details and comments:

![stars-knowMore-comments](https://github.com/Nicolas-CHRETIEN/my-lucky-star/assets/132827127/a18baa99-3be6-47eb-9b43-06c26771a989)


When you select a product, the server sends all product information and you have the possibility to add a comment on the product.
If you want to answer to one comment in particular, you can answer this comment.
Then the name of the comment's user will be added to your answer which will be located just below the comment.


### The account page:

![stars-myAccount](https://github.com/Nicolas-CHRETIEN/my-lucky-star/assets/132827127/1ebf5afa-9620-41e0-8e5b-606b4bfa985f)

The account page give you many information on a user activity such as the product he created, the comments he send etc...
From this page you can access to all users account page.


### The data base:

![BDD](https://github.com/Nicolas-CHRETIEN/my-lucky-star/assets/132827127/561203f8-c3fa-4595-b16f-54c23041b464)

In the picture above you can see the relations between tables and the different fields of each table.












