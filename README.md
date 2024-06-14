# Vonage Video Getting Started Sample App

<img src="https://assets.tokbox.com/img/vonage/Vonage_VideoAPI_black.svg" height="48px" alt="Tokbox is now known as Vonage" />

A simple server that uses the [Vonage PHP Video SDK](https://github.com/Vonage/vonage-php-sdk-video)
to create Vonage Video API sessions and generate tokens for those sessions, using Vonage API credentials
(a Vonage application ID and private key). You can either quick deploy via Vonage's Code Hub or run the project locally.

## Quick deploy

### Vonage Code Hub

While this code can be run locally or on your own server, this code is also available as a project on Vonage's [Code Hub](https://developer.vonage.com/en/cloud-runtime/2d83d050-eed0-48a9-a2ac-6479d161c7d6_vonage-video-learning-server-php). From there you can deploy directly to your Vonage account with almost all of the settings pre-configured for you, including a publically accessible web address you can use with front-end projects.

You can either deploy the code as-is by clicking on "Deploy Code", or if you would like to make edits to the source code you can click "Get Code" to be dropped into an editor. You can then customize the sample application and deploy to Vonage Cloud Runtime.

If you choose "Get Code" once the workspace opens you can start debugging the project by running this command in the "Terminal":

```
vcr debug
```

The terminal will give you a debug URL which you can use while you are interating over your code. Once you are ready to deploy, run this command:

```
vcr deploy
```

View the [deploying guide](https://developer.vonage.com/vcr/guides/deploying) to learn more about deploying on Vonage Cloud Runtime which powers Code Hub.

## Run Locally 

## Requirements

- [Composer](https://getcomposer.org/)
- [PHP 7.3 or higher](https://php.net)

## Installation & Running on localhost

  1. Clone the app by running the command
  
          git clone git@github.com:vonage-community/sample-video-php-learning_server.git

  2. `cd` to the root directory.

  3. Run `composer install` command to fetch and install all dependencies.

  4. Next, copy the `.env.dist` file to `.env` and edit to add your Vonage application ID and the
     path to the private key file for that application:

      ```
      API_APPLICATION_ID=824e6a17-7830-4343-8b97-2b72f9d09cdc
      PRIVATE_KEY="/Users/bob/path-to-key/your-private-key.key"
      ENABLE_LOGGING=false
      LOGGING_PATH='/Users/bob/path-to-the-log-files-directory'
      ```

   5. Start the server using composer:

    `$ composer run --timeout 0 serve`

  6. Visit the URL <http://localhost:3000/room/roomName> in your browser. (Replace `roomName` with a unique
     room name. You should see a JSON response containing the OpenTok API key, session ID, and token.

  7. Visit the URL <http://localhost:3000/room/roomName/join> in your browser. You should see a page with
     a test Video API session with a Video API publisher video. Open the page in another browser.
     You should see a page with a publisher and subscriber video.
     
     * Click the *Start Archive* button to start recording the session.

     * Click the *Stop Archive* button to stop recording the session.

     * Click the *View archive info* button to view details about the archive.

     * Click the *View archive* button to view the archive recording.

     * Click the *Send signal from server* button to have the server send a signal to the session.