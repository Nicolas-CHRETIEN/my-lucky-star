# my-lucky-star: a fictional dystopic website.

After I learned PHP and the OOP, I wanted to learn to code with my first framework. 
Symfony seemed to be the best choice as many developers gave me a great return.

## The main goal to this exercise:
Create a full CRUD website with a SQL database, routes and templates in twig.

The style was once again not my first priority, so I mainly used bootstrap to go faster and have a responsive finish.

As always, I trained myself with a subject which I love: Astronomy and more precisely: science fiction.
The website is a dystopic website made to buy and sell stars.
Of course, this is not a real project.

### Home:

![Capture](https://github.com/Nicolas-CHRETIEN/my-lucky-star/assets/132827127/6d9a5a20-6221-44ea-9e42-3b19579f8bc0)



The home page can be reach by any user. 
It contains some information about stars and the universe to simulate a real marketing website with information on the products.

The home page is the only page you can access without register with the stars page which contains the products and the register page.

### A restricted access:

![register](https://github.com/Nicolas-CHRETIEN/my-lucky-star/assets/132827127/4ed87f62-f6dc-49f6-8926-e11cb4a95402)


If you're not registered you can't access to many functionalities:
  - You can't comment a product, or answer to a comment
  - You can't create a star
  - You can't of course access to your account page with all your information.

There are three types of users:
  - the not registered users, as explained above
  - the normal users: they can create a star, modify stars they created, add a comment and answer to a comment or delete a comment they created.
  - the admin: They can do everything: delete/update any star, delete any comment.


### The products:

![stars-filters](https://github.com/Nicolas-CHRETIEN/my-lucky-star/assets/132827127/39cd6357-d8c4-4d6f-b123-dbd6793b1c9d)



Here products are real stars.
They are displayed in the shape of cards. You can have further information on the product if you click on the card.
You have on the left side several filters to select the type of product you want.

As I created a lot of data for this website, I let the possibility to show only 10 results per page by creating a pagination system:

![stars-pagination](https://github.com/Nicolas-CHRETIEN/my-lucky-star/assets/132827127/a03ddd62-79ac-464c-b19f-97566a393cc4)



### The creation / update:


![stars-create-update-star](https://github.com/Nicolas-CHRETIEN/my-lucky-star/assets/132827127/c20d1895-e2a9-4d09-a1e3-e732b7e2e28a)



If you have the access, you can create or update a star.
I created a form to collect data and adding it to the database.
If you update the star, the current information are indicated by default.


### Product details and comments:

![stars-knowMore-comments](https://github.com/Nicolas-CHRETIEN/my-lucky-star/assets/132827127/b88774c7-b9be-4231-a4bf-edef5fb32172)



When you select a product, the server sends all product information and you have the possibility to add a comment on the product.
If you want to answer to one comment in particular, you can answer this comment.
Then the name of the comment's user will be added to your answer which will be located just below the comment.


### The account page:

![stars-myAccount](https://github.com/Nicolas-CHRETIEN/my-lucky-star/assets/132827127/33141541-1aa8-4072-8e3f-7e6bbc6b1beb)


The account page give you many information on a user activity such as the product he created, the comments he send etc...
From this page you can access to all users account page.


### The data base:

![BDD](https://github.com/Nicolas-CHRETIEN/my-lucky-star/assets/132827127/e668a4b5-c1a6-4f0a-ae83-f08fbc47d359)


In the picture above you can see the relations between tables and the different fields of each table.












