import os
import datetime
import time
import pymysql
import json
import requests





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
#checking status
def check_ping_status(equipData,connection):
    
        
            for equip in equipData:
                print ("equip[0]", equip[0])
                hostname= equip[4] 
                response = os.system("ping -n 1 " + hostname)  
    
                if response == 0:
                    print(f"{hostname} is up")
                    status = 'up'
                    updateStatus(status,connection,equip)

                else:
                    print(f"{hostname} is down")
                    status = 'down'
                    updateStatus(status,connection,equip)
            
    
def updateStatus(status, connection, equip):
    try:
        with connection.cursor() as cursor:
           
            # update history table

            
            sqlSelect = "SELECT latestDownDate FROM historylog WHERE ip = %s"
            cursor.execute(sqlSelect, equip[4])
            existing_data = cursor.fetchone()
            sqlSelectRecovery = "SELECT recoveryDate FROM historylog WHERE ip = %s"
            cursor.execute(sqlSelectRecovery, equip[4])
            existing_data_recovery = cursor.fetchone()

            if existing_data is not None and existing_data[0] is not None:
                data_dict = json.loads(existing_data[0])
                json_length = len(data_dict)
                # checking if recoverydate list is empty or not
                if existing_data_recovery is not None and existing_data_recovery[0] is not None:
                    data_dict_recovery = json.loads(existing_data_recovery[0])
                    json_length_recovery = len(data_dict_recovery)
                    
                else:
                # If no data exists or it's None, create an empty dictionary
                    data_dict_recovery = {}
                    json_length_recovery = 0

                # checking if it's down and has  recovered 
                if ((json_length > json_length_recovery) and status == "up"):
                    
                    data_dict_recovery[len(data_dict_recovery)] = str(datetime.datetime.now())
                    json_data_recovery = json.dumps(data_dict_recovery)
                    sqlUpdate = "UPDATE historylog SET recoveryDate = %s WHERE ip = %s" 
                        
                    cursor.execute(sqlUpdate, (json_data_recovery,equip[4]))
                     #  update equipments table
                    sql = "UPDATE equipments SET status = %s WHERE id = %s"
                    sqlDownDate = "UPDATE equipments SET latestDownDate = %s WHERE id = %s"
                    sqlDownDateMs = "UPDATE equipments SET latestDownDateMs = %s WHERE id = %s"
                    cursor.execute(sql, (status, equip[0]))
                    cursor.execute(sqlDownDate, (datetime.datetime.now(), equip[0]))
                    cursor.execute(sqlDownDateMs, (int(time.time()*1000), equip[0]))
                # was up but just fallen down
                elif ((json_length == json_length_recovery)  and status == "down"):

                    data_dict[len(data_dict)] = str(datetime.datetime.now())
                    json_data = json.dumps(data_dict)
                    sqlLog = "UPDATE historylog SET latestDownDate = %s WHERE ip = %s"
                    cursor.execute(sqlLog, (json_data, equip[4]))
                     #  update equipments table
                    sql = "UPDATE equipments SET status = %s WHERE id = %s"
                    sqlDownDate = "UPDATE equipments SET latestDownDate = %s WHERE id = %s"
                    
                    cursor.execute(sql, (status, equip[0]))
                    cursor.execute(sqlDownDate, (datetime.datetime.now(), equip[0]))
                   
                else:
                    print("No update")
            


                


            else:
                if (status == "down"):
                    # If no data exists for the IP, create an empty dictionary
                    data_dict = {}
                    

                # Add the new key-value pair to the dictionary
                    data_dict[len(data_dict)] = str(datetime.datetime.now())

                        # INSERT INTO my_table (data_column) VALUES ('{"key1": "value1", "key2": "value2", "key3": "value3"}');
                    
                    json_data = json.dumps(data_dict)
                    sqlLog = "UPDATE historylog SET latestDownDate = %s WHERE ip = %s"
                    cursor.execute(sqlLog, (json_data, equip[4]))
                     #  update equipments table
                    sql = "UPDATE equipments SET status = %s WHERE id = %s"
                    sqlDownDate = "UPDATE equipments SET latestDownDate = %s WHERE id = %s"
                    
                    cursor.execute(sql, (status, equip[0]))
                    cursor.execute(sqlDownDate, (datetime.datetime.now(), equip[0]))
                    

                                    
            connection.commit()  # Commit the changes to the database
            print("Status updated successfully!")
            

    except pymysql.Error as e:
        connection.rollback()  # Rollback changes in case of any error
        print("Failed to update status:", e)
        
# Main function

def main():

    # Connect to the database
    connection = connectDatabase()

    if connection:
        # Retrieve equipment data
        equipment_data = getEquipmenntData(connection)

        if equipment_data:
            # Supervise equipment status
           check_ping_status(equipment_data,connection)
        x=requests.get("http://localhost/NiceAdmin2/mbtf.php")
        connection.close()
    else:
        print("Exiting script due to database connection error.")

    return ''

if __name__ == '__main__':
   main()

