#define PLUGIN_VERSION "1.2.1"
#include <sourcemod>
#pragma semicolon 1
#pragma newdecls required

Database hDatabase = null;

public const char DBQueriesLogs[2][] =
{
	"CREATE TABLE IF NOT EXISTS `logging` (`id` INT(10) NOT NULL AUTO_INCREMENT, `server` VARCHAR(64) NOT NULL, `name` VARCHAR(64) NOT NULL, `steamid` VARCHAR(64) NOT NULL, `command` VARCHAR(256) NOT NULL, `date` VARCHAR(64) NOT NULL, PRIMARY KEY (`id`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",
	"INSERT INTO logging (server, steamid, name, command, date) VALUES ('%s', '%s', '%s', '%s', '%s');"
};

public Plugin myinfo = 
{
	name = "Admin Logs PHP",
	author = "yelks",
	description = "",
	version = PLUGIN_VERSION,
	url = "http://steamcommunity.com/profiles/76561198164353433"
};

public void OnPluginStart()
{
	delete hDatabase;
	
	char error[255];
	if (SQL_CheckConfig("logging"))
	{
		hDatabase = SQL_Connect("logging", true, error, 255);
		
		if (hDatabase == null)
		{
			SetFailState("[logging] Error on start. Reason: %s", error);
		}
	}
	
	if (!SQL_FastQuery(hDatabase, DBQueriesLogs[0]))
	{
		SQL_GetError(hDatabase, error, 255);
		LogError("[logging] Can't create table. Error : %s", error);
	}
}

public Action OnLogAction(Handle source, Identity ident, int client, int target, const char[] message)
{
	if (client < 1|| GetUserAdmin(client) == INVALID_ADMIN_ID)
		return Plugin_Continue;
	
	char query[1024], authid[32], name[64], hostname[64], Time[64], error[255];
	GetClientAuthId(client, AuthId_SteamID64, authid, sizeof(authid));
	GetClientName(client, name, sizeof(name));
	GetConVarString(FindConVar("hostname"), hostname, sizeof(hostname));
	FormatTime(Time, sizeof(Time), "%F %R", GetTime());
	
	Format(query, sizeof(query), DBQueriesLogs[1], hostname, authid, name, message, Time);
	
	if (!SQL_FastQuery(hDatabase, query))
	{
		SQL_GetError(hDatabase, error, 255);
		LogError("[logging] Can't log command. Error : %s", error);
	}
	
	return Plugin_Handled;
}
