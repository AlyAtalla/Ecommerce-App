   <?php
   require_once __DIR__ . '/../vendor/autoload.php';
   require_once __DIR__ . '/../schema.php';

   use GraphQL\GraphQL;
   use GraphQL\Error\Debug;
   use GraphQL\Error\FormattedError;

   $rawInput = file_get_contents('php://input');
   $input = json_decode($rawInput, true);
   $query = $input['query'];
   $variableValues = isset($input['variables']) ? $input['variables'] : null;

   try {
       $result = GraphQL::executeQuery($schema, $query, null, null, $variableValues);
       $output = $result->toArray(Debug::INCLUDE_DEBUG_MESSAGE | Debug::INCLUDE_TRACE);
   } catch (\Exception $e) {
       $output = [
           'errors' => [
               FormattedError::createFromException($e, Debug::INCLUDE_DEBUG_MESSAGE | Debug::INCLUDE_TRACE)
           ]
       ];
   }

   header('Content-Type: application/json');
   echo json_encode($output);
   ?>
   



