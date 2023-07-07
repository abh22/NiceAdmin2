import time
import pymysql
import telnetlib


#connecting to database
def connectDatabase():
    try:
        connection=pymysql.connect(host='localhost',
                                   user='root',
                                   password='',
                                   database='stage01')
        return connection
    except pymysql.Error as e:
        print("Failed connection:",e)

#fetching data
def getEquipmenntData(connection):
    try:
        with connection.cursor() as cursor:
            sql="SELECT * FROM equipments"
            cursor.execute(sql)
            equipData=cursor.fetchall()
            return equipData
    except pymysql.Error as e:
        print("failed fetching data:",e)
def to_bytes(line):
    return f"{line}\n".encode("utf-8")
#supervise with telnet
def superviseEquipment(equipData):
    commands=["show runing-config"]
    print("equipData[0]:",equipData[0])
    for equip in equipData:
        print("equip:",equip)
        equip_ip=equip[4]
        print ("equipip:",equip_ip)
        equip_username="cisco"
        equip_password="tp"

        try:
            with telnetlib.Telnet(equip_ip) as telnet:
                
                
                telnet.read_until(b"Password")
                telnet.write(to_bytes(equip_password))
                index, m, output = telnet.expect([b">", b"#"])
                if index == 0:
                    telnet.write(b"enable\n")
                    telnet.read_until(b"Password")
                    telnet.write(to_bytes("rp"))
                    telnet.read_until(b"#", timeout=5)
                telnet.write(b"terminal length 0\n")
                telnet.read_until(b"#", timeout=5)
                time.sleep(3)
                telnet.read_very_eager()

                result = {}
                for command in commands:
                    telnet.write(to_bytes(command))
                    output = telnet.read_until(b"#", timeout=5).decode("utf-8")
                    result[command] = output.replace("\r\n", "\n")
                return result

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
        equipment_data = getEquipmenntData(connection)

        if equipment_data:
            # Supervise equipment status
            superviseEquipment(equipment_data)

        connection.close()
    else:
        print("Exiting script due to database connection error.")

if __name__ == '__main__':
    main()
