#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>

#include <mysql/mysql.h>

main()
{
        char str[2024];
        int sock,a;
        struct sockaddr_in addr;
        unsigned long int addr1;
        int port;
        int i;
        int a1,a2,a3,a4;

        MYSQL mysql1;
        MYSQL_RES *res;
        MYSQL_ROW row;

        mysql_init (&mysql1);
        if (!mysql_real_connect(&mysql1,"localhost","root","","pingui",0,0,0)) {printf ("mysql db error\n");return;}
        snprintf (str,1023,"SELECT host.ID,rkp.pip,host.ip,host.port FROM rkp,host WHERE host.rkpID=rkp.ID ORDER BY host.ID;");
        printf ("%s\n",str);
        if (mysql_query(&mysql1,str)) {printf ("mysql select error\n");return;}
        res=mysql_store_result(&mysql1);

        for (i=0;i<mysql_num_rows(res);i++)
        {
                row=mysql_fetch_row(res);
                addr1=atoi(row[1])+atoi(row[2]);
                port=atoi(row[3]);

                sock=socket(AF_INET, SOCK_STREAM, 0);

                addr.sin_family=AF_INET;
                addr.sin_port=htons(port);
                addr.sin_addr.s_addr=htonl(addr1);

                printf ("%s.%s:%d",row[0],row[2],port);
                if (a1=connect (sock,(struct sockaddr *) &addr, sizeof (addr)))
                {//error when connecting, change color to red;
                        printf ("-%d\n",a1);
                        snprintf (str,1023,"INSERT INTO pings VALUES (%s, now(), %d);",row[0], a1);
                        if (mysql_query(&mysql1,str)) {printf ("mysql select error\n");return;}
                        snprintf (str,1023,"UPDATE host SET color='#ff9494' WHERE ID=%s",row[0]);
                        if (mysql_query(&mysql1,str)) {printf ("mysql select error\n");return;}
                }
                else {
                        printf ("+\n");
                        snprintf (str,1023,"INSERT INTO pings VALUES (%s, now(), 0);",row[0]);
                        if (mysql_query(&mysql1,str)) {printf ("mysql select error\n");return;}
                        snprintf (str,1023,"UPDATE host SET color='#42ff9e' WHERE ID=%s",row[0]);
                        if (mysql_query(&mysql1,str)) {printf ("mysql select error\n");return;}

                }

                close (sock);

        }
        mysql_close (&mysql1);
}
