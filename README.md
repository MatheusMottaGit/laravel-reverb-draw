# Draw System API Documentation

## Overview
This API provides endpoints for managing a real-time draw system where users can join a room, participate in a draw, and restart the process. The system uses WebSocket broadcasting for real-time updates.

## API Endpoints

### 1. Enter Room
- **Endpoint:** `POST /api/enter`
- **Description:** Allows a user to enter the draw room
- **Request Body:**
  ```json
  {
    "nickname": "string"
  }
  ```
- **Responses:**
  - 200 OK: User successfully joined
    ```json
    {
      "message": "User joined the room!"
    }
    ```
  - 400 Bad Request: If nickname is already taken or room is full
    ```json
    {
      "message": "This nickname is already in the room."
    }
    ```
    or
    ```json
    {
      "message": "The room is full."
    }
    ```

### 2. Start Draw
- **Endpoint:** `POST /api/start`
- **Description:** Initiates the draw process when the room is full
- **Responses:**
  - 200 OK: Draw completed successfully
    ```json
    {
      "message": "We have a winner! [winner_name]"
    }
    ```
  - 400 Bad Request: If room is not full
    ```json
    {
      "message": "Room is not full yet."
    }
    ```

### 3. Restart Draw
- **Endpoint:** `POST /api/restart`
- **Description:** Clears the room and allows for a new draw session
- **Responses:**
  - 200 OK: Room cleared successfully
    ```json
    {
      "message": "Room cleaned."
    }
    ```
  - 400 Bad Request: If room is already empty
    ```json
    {
      "message": "Room is empty."
    }
    ```

## Real-time Events

The system broadcasts the following events on the 'draw' channel:

1. **UserJoined Event**
   - Triggered when a new user joins the room
   - Payload includes the new user's nickname and updated participants list

2. **DrawStarted Event**
   - Triggered when the draw is initiated
   - Payload includes the winner's name

## Special Notes
- The system has a maximum participant limit (configurable via `MAX_PARTICIPANTS_COUNT` environment variable)
- There is a special admin user with the nickname "admin123"
- The system uses Laravel's cache system to maintain the state of participants
