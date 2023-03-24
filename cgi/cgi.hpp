#ifndef CGI_HPP
#define CGI_HPP

#include <iostream>
#include <unistd.h>
#include <fcntl.h>
#include <cstdlib>

class cgi{
    public:
		enum {
			NONE = 0, DONE = 1, ERROR = -1
		};
    private:
        std::string path;
        int cgi_pid;
        int pid_status;
        char **env;
        char **args;
        int in_fd;
        int out_fd;
        std::string out_path;
        std::string php;
        std::string py;
        std::string outname;
    public:
        cgi(std::string p);
        ~cgi();
        int get_cgi_pid();
        void fill_env();
        void exec_cgi(char **args, char **env, int fd);
        void wait_cgi();
        void exec();
        int check_extension(std::string str);
        void fill_args();
        std::string random_name();
        std::string get_outfile_path();
        class fork_error: public std::exception
        {
            const char* what() const throw()
            {
                return ("fork failed");
            }
        };
        class cgi_open_error: public std::exception
        {
            const char* what() const throw()
            {
                return ("CGI open failed");
            }
        };
        class extension_error: public std::exception
        {
            const char* what() const throw()
            {
                return ("Unknown extension");
            }
        };
};

int check_extension2(std::string name);

#endif