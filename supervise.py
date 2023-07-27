import os
import datetime
import time
import pymysql





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
            sql = "UPDATE equipments SET status = %s WHERE id = %s"
            sqlDownDate = "UPDATE equipments SET latestDownDate = %s WHERE id = %s"
            sqlDownDateMs = "UPDATE equipments SET latestDownDateMs = %s WHERE id = %s"
            cursor.execute(sql, (status, equip[0]))
            cursor.execute(sqlDownDate, (datetime.datetime.now(), equip[0]))
            cursor.execute(sqlDownDateMs, (int(time.time()*1000), equip[0]))

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

        connection.close()
    else:
        print("Exiting script due to database connection error.")

    return ''

if __name__ == '__main__':
   main()

