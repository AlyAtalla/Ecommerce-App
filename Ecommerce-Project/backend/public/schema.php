   <?php
   use GraphQL\Type\Schema;
   use GraphQL\Type\Definition\Type;
   use GraphQL\Type\Definition\ObjectType;

   $queryType = new ObjectType([
       'name' => 'Query',
       'fields' => [
           'hello' => [
               'type' => Type::string(),
               'resolve' => function() {
                   return 'Hello, world!';
               }
           ]
       ]
   ]);

   $schema = new Schema([
       'query' => $queryType
   ]);
   ?>
   



