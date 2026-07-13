import serial
import mysql.connector
import time
import traceback

# =========================
# Arduino Serial Connection
# =========================

arduino = serial.Serial(
    port="COM8",
    baudrate=9600,
    timeout=2
)

time.sleep(2)

print("Arduino Connected")


# =========================
# MySQL Database Connection
# =========================

db = mysql.connector.connect(
    host="127.0.0.1",
    user="root",
    password="AhmadAfghan9981",
    database="pharmacy"
)

print("Database Connected:", db.is_connected())


cursor = db.cursor()


# =========================
# Main Loop
# =========================

while True:

    try:

        # Read data from Arduino
        data = arduino.readline().decode(errors="ignore").strip()

        print("Received:", repr(data))

        # Check if Arduino sent correct format
        parts = data.split(",")

        if len(parts) == 2:

            temperature = float(parts[0])
            humidity = float(parts[1])

            # Determine status
            if temperature > 30 or temperature < 25:

                status = "Danger"
                alarm = 1

                arduino.write(b"RED\n")

            else:

                status = "Normal"
                alarm = 0

                arduino.write(b"GREEN\n")

            # Insert into database
            sql = """
            INSERT INTO temperature_logs
            (temperature, humidity, status, alarm)
            VALUES (%s, %s, %s, %s)
            """

            values = (
                temperature,
                humidity,
                status,
                alarm
            )

            cursor.execute(sql, values)
            db.commit()

            print("----------------------------")
            print("Temperature:", temperature)
            print("Humidity:", humidity)
            print("Status:", status)
            print("Inserted Successfully")

        else:

            print("Invalid data format")

    except ValueError:

        print("Sensor returned invalid numbers")

    except Exception:

        traceback.print_exc()

    time.sleep(2)
