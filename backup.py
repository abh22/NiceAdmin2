import time
import pymysql
import telnetlib

#connecting to database
def connectDatabase():
    try:
        connection = pymysql.connect(
            host='localhost',
            user='root',
            password='',
            database='stage01'
        )
        return connection
    except pymysql.Error as e:
        print("Failed connection:", e)

#fetching data
def getEquipmentData(connection):
    try:
        with connection.cursor() as cursor:
            sql = "SELECT * FROM equipments"
            cursor.execute(sql)
            equipData = cursor.fetchall()
            return equipData
    except pymysql.Error as e:
        print("failed fetching data:", e)

def to_bytes(line):
    return f"{line}\n".encode("utf-8")

#supervise with telnet
def superviseEquipment(equipData):
    commands = ["show running-config", "display current-configuration"]
    print("equipData[0]:", equipData[0])
    for equip in equipData:
        print("equip:", equip)
        equip_brand = equip[2]
        equip_ip = equip[4]
        print("equipip:", equip_ip)
        
        password = "tp"

        try:
            with telnetlib.Telnet(equip_ip) as telnet:
                telnet.read_until(b"Password:")
                telnet.write(to_bytes(password))
                index, m, output = telnet.expect([b">", b"#"])
                if index == 0:
                    telnet.write(b"enable\n")
                    telnet.expect(b"Password:")
                    telnet.write(to_bytes("rp"))
                    telnet.expect(b"#")
                if equip_brand == "Cisco":
                    telnet.write(b"terminal length 0\n")
                elif equip_brand == "Huawei":
                    telnet.write(b"screen-length 0 temporary\n")
                telnet.expect(b"#")

                if equip_brand == "Cisco":
                    telnet.write(to_bytes(commands[0]))
                elif equip_brand == "Huawei":
                    telnet.write(to_bytes(commands[1]))

                output = telnet.read_until(b"#", timeout=5).decode("utf-8")

                # Close the Telnet connection
                telnet.close()
                filename = f"{equip_ip}_config.txt"
                with open(filename, 'w') as file:
                    file.write(output)

                print(f"Configuration saved to {filename}")

            print("Connection closed.")
        except ConnectionRefusedError:
            print("Connection refused for", equip_ip)
        except Exception as e:
            print("Error connecting or running commands on", equip_ip, ":", e)

# Main function
def main(): 
    # Connect to the database
    connection = connectDatabase()

    if connection:
        # Retrieve equipment data
        equipment_data = getEquipmentData(connection)

        if equipment_data:
            # Supervise equipment status
            superviseEquipment(equipment_data)

        connection.close()
    else:
        print("Exiting script due to database connection error.")

if __name__ == '__main__':
    main()
