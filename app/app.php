<?php
    // connects created classes to the project
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Letter.php";
    require_once __DIR__."/../src/Word.php";

    // creates a new app using the Silex micro framework
    $app = new Silex\Application();
    $app['debug'] = true;

    // adds Twig as the service provider for the app templates and sets the twig path to where the templates will be located
    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../web/views'));

    // route main page
    $app->get("/", function() use ($app) {
        return $app['twig']->render('forms.html.twig');
    });

    // routing for after form is submitted
    $app->post("/words", function() use ($app) {
        $user_input = $_POST['letter-input'];
        $user_letter = new Word($user_input);
        return $app['twig']->render('forms.html.twig', array('wordObject' => $user_letter));
    });

    // routing for after form is submitted
    $app->post("/points", function() use ($app) {
        $word = $_POST['word-input'];
        $user_word = new Word($word);
        return $app['twig']->render('points.html.twig', array('wordObject' => $user_word));
    });

    return $app;
?>
