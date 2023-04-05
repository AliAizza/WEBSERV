FLAGS = -Wall -Wextra -Werror -std=c++98
SRC = main.cpp 
CC = c++

all : webserv $(SRC)

webserv : $(SRC)
	@$(CC) $(FLAGS) $(SRC) -o webserv

clean :
	@tput setaf 1; echo "CLEAN COMPLET"
	@rm -rf webserv

fclean : clean

re: fclean all